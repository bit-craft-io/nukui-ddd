<?php

declare(strict_types=1);

namespace App\Domains\Gacha\Service;

use App\Core\Exceptions\Enums\TypeExcept;
use App\Core\Libraries\Traits\TraitApplication;
use App\Core\Libraries\Traits\TraitDomain;
use App\Core\Libraries\Traits\TraitException;
use App\Core\Libraries\Traits\TraitInfrastructure;
use App\DataSources\DsHub;
use App\Domains\Gacha\EntGacha;
use App\Domains\Gacha\VoMGacha;
use App\Domains\Gacha\VoHub;
use App\Domains\RepHub;
use Exception;

// TODO 削除
//use App\Master\MstGacha;
//use App\Master\MstGachaDrawEntity;
//use App\Master\MstHub;
//use Illuminate\Support\Arr;

class SvcGacha
{
    use TraitApplication;
    use TraitDomain;
    use TraitException;
    use TraitInfrastructure;

    /**
     * @throws Exception
     */
    public function draw(int $user_id, int $gacha_id): array
    {
        // TODO 削除
        //$this->_Domain::vo(VoHub::VO_M_GACHA)->find($id);
        //$this->_Domain::vo(VoHub::VO_M_GACHA)->get();

        $rep_gacha = $this->_Domain::rep(RepHub::REP_GACHA);
        $ent_gacha = $rep_gacha->find($user_id);
        if ($ent_gacha->isEmpty()) {
            $ent_gacha = $rep_gacha->draft($user_id);
        }

        $vo_gacha = $this->_Domain::vo(VoHub::VO_M_GACHA)->find($gacha_id);
        if (!$vo_gacha->validate()) {
            throw $this->_Except::app(TypeExcept::AppGachaMasterIsNotValid);
        }

        $draw_lots = match (true) {
            $vo_gacha->type_draw->isNormal() => $this->_normal($vo_gacha, $ent_gacha),
            $vo_gacha->type_draw->isRarity() => $this->_rarity($vo_gacha, $ent_gacha),
            $vo_gacha->type_draw->isStep() => $this->_step($vo_gacha, $ent_gacha),
        };

        $ent_gacha->addExecCount($vo_gacha->group_no);
        $rep_gacha->persist($ent_gacha);

        return $draw_lots;
    }

    private function _normal(VoMGacha $vo_gacha, EntGacha $ent_gacha): array
    {
        $conditions = ['group_no' => $vo_gacha->gacha_draw_entity_group_no];
        $m_gacha_draw_entities = $this->_Infra::ds(DsHub::DS_M_GACHA_DRAW_ENTITY)->getEnable($conditions);

        $sorted_rates = $m_gacha_draw_entities->sortByDesc('rate')->values()->toArray();
        $cum_rates = $this->_cumulativeRate($sorted_rates);
        $sum_rate = end($cum_rates);

        $draw_lots = [];
        for ($i = 0; $i < $vo_gacha->draw_count; $i++) {
            $draw_lots[] = $this->_drawLot($sorted_rates, $sum_rate, $cum_rates, ['type_entity', 'entity_id', 'entity_amount']);
        }
        return $draw_lots;
    }

    private function _rarity(VoMGacha $vo_gacha, EntGacha $ent_gacha): array
    {
        // @note レアリティ抽選用のデータ取得
        $conditions = ['group_no' => $vo_gacha->gacha_draw_rarity_group_no];
        $m_gacha_draw_rarities = $this->_Infra::ds(DsHub::DS_M_GACHA_DRAW_RARITY)->getEnable($conditions);

        // @note レアリティ抽選用のデータ作成
        $rarity_sorted_rates = $m_gacha_draw_rarities->sortByDesc('rate')->values()->toArray();
        $rarity_cum_rates = $this->_cumulativeRate($rarity_sorted_rates);
        $rarity_sum_rate = end($rarity_cum_rates);

        // @note エンティティ抽選用のデータ取得
        $conditions = ['group_no' => $vo_gacha->gacha_draw_entity_group_no];
        $m_gacha_draw_entities = $this->_Infra::ds(DsHub::DS_M_GACHA_DRAW_ENTITY)->getEnable($conditions);

        $entities = [];
        $draw_lots = [];
        for ($i = 0; $i < $vo_gacha->draw_count; $i++) {

            // @note レアリティ抽選
            $lot_results = $this->_drawLot($rarity_sorted_rates, $rarity_sum_rate, $rarity_cum_rates, ['type_rarity']);
            $type_rarity = $lot_results['type_rarity'];

            // @note エンティティ抽選用のデータ作成
            if (empty($entities[$type_rarity])) {
                $entities[$type_rarity] = $m_gacha_draw_entities->filter(fn($entity): bool => $entity->type_rarity->value == $type_rarity);
            }

            $sorted_rates = $entities[$type_rarity]->sortByDesc('rate')->values()->toArray();
            $cum_rates = $this->_cumulativeRate($sorted_rates);
            $sum_rate = end($cum_rates);

            // @note エンティティ抽選
            $draw_lots[] = $this->_drawLot($sorted_rates, $sum_rate, $cum_rates, ['type_entity', 'entity_id', 'entity_amount']);
        }
        return $draw_lots;
    }

    private function _step(VoMGacha $vo_gacha, EntGacha $ent_gacha): array
    {
        // @note 実行回数 $vo_gacha->exec_count でユーザのステップの状態を管理
        if ($vo_gacha->exec_count !== $ent_gacha->getExecCount($vo_gacha->group_no)) {
            // TODO エラー出力にオプションを追加
            //dd('not equal step = ' . $vo_gacha->exec_count . ' | ' . $ent_gacha->getExecCount($vo_gacha->group_no));
            throw $this->_Except::app(TypeExcept::AppGachaStepNotEqual);
        }

        // TODO m_gachas.exec_limit_count, m_gachas.is_exec_loop を追加
        return $this->_normal($vo_gacha, $ent_gacha);
    }

    private function _cumulativeRate(array $sorted_rates): array
    {
        $cum_rate = 0;
        $cum_rates = [];
        foreach ($sorted_rates as $sorted_rate) {
            $cum_rate += $sorted_rate['rate'];
            $cum_rates[] = $cum_rate;
        }
        return $cum_rates;
    }

    private function _drawLot(array $sorted_rates, int $sum_rate, array $cum_rates, array $lot_filter = []): array
    {
        $lot_num = mt_rand(1, $sum_rate);

        $left = 0;
        $right = count($cum_rates) - 1;
        $lot_filter_key = array_flip($lot_filter);
        while ($left <= $right) {
            $mid = intdiv($left + $right, 2);
            if ($lot_num <= $cum_rates[$mid]) {
                if ($mid === 0 || $lot_num > $cum_rates[$mid - 1]) {
                    $lottery = $sorted_rates[$mid];
                    return array_intersect_key($lottery, $lot_filter_key);
                }
                $right = $mid - 1;
            } else {
                $left = $mid + 1;
            }
        }
        return [];
    }
}
