<?php

declare(strict_types=1);

namespace App\Domains\Gacha\Service;

use App\Core\Libraries\Traits\TraitApplication;
use App\Master\MstGacha;
use App\Master\MstGachaDrawEntity;
use App\Master\MstHub;

class SvcGacha
{
    use TraitApplication;

    public function draw(MstGacha $m_gacha): array
    {
        return match(true) {
            $m_gacha->type_draw->isNormal() => $this->normal($m_gacha),
        };
    }

    public function normal(MstGacha $m_gacha): array
    {
        // TODO 比較的アンチパターン
        // TODO ドメイン内でmstをcall
        $m_gacha_lot_entities = $this->_App::mst(MstHub::MST_GACHA_DRAW_ENTITY)->get(['group_no' => $m_gacha->group_no]);

        //dd($m_gacha_lot_entities->collection());
        $models = $m_gacha_lot_entities->models();
        $rates = $models->sortByDesc('rate')->values()->toArray();
        $sum_rate = $models->pluck('rate')->sum();
        $ret = $this->_lottery($rates, $sum_rate);
        dd($ret);

        return [];
//        $m_gacha = $this->_App::mst(MstHub::MST_GACHA)->find($gacha_id);
//        $m_gacha_lot_entities = $this->_App::mst(MstHub::MST_GACHA_LOT_ENTITY)->getByGroupNo($m_gacha->gacha_lot_group_no);
//        dd($m_gacha_lot_entities->toArray());
    }
//
//    public function step(int $gacha_id): string
//    {
//
//    }
//
//    public function fixed(int $gacha_id): string
//    {
//
//    }

    private function _lottery(array $rates, int $sum_rate): array
    {
        // @note 線形探索より二分探索の方が良い
        $lot_num = mt_rand(1, $sum_rate);
        $cumulative = [];
        $sum = 0;
        foreach ($rates as $value) {
            $sum += $value['rate'];
            $cumulative[] = $sum;
        }

        $left = 0;
        $right = count($cumulative) - 1;

        while ($left <= $right) {
            $mid = intdiv($left + $right, 2);
            if ($lot_num <= $cumulative[$mid]) {
                if ($mid === 0 || $lot_num > $cumulative[$mid - 1]) {
                    // @note データの調整 item_id が無い為、追加
                    $lottery = $rates[$mid];
                    $lottery += [
                        'item_id' => $lottery['id'],
                        'reward_type' => $lottery['item'] ?? 'item',
                        'num' => $lottery['num'] ?? 1
                    ];
                    return $lottery;
                }
                $right = $mid - 1;
            } else {
                $left = $mid + 1;
            }
        }
        return [];
    }
}
