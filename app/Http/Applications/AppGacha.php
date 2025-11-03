<?php

declare(strict_types=1);

namespace App\Http\Applications;

use App\Core\Exceptions\Enums\TypeExcept;
use App\Core\Http\Applications\BaseApp;
use App\Core\Http\Requests\ReqNone;
use App\Domains\EntHub;
use App\Domains\Gacha\Service\SvcGacha;
use App\Domains\Gacha\VoHub;
use App\Domains\RepHub;
use App\Domains\SvcHub;
use App\Http\Requests\Gacha\ReqGachaPlay;
use App\Master\MstHub;
use Exception;

class AppGacha extends BaseApp
{
    public function get(ReqNone $req): void
    {
    }

    /**
     * @param ReqGachaPlay $req
     * @return void
     * @throws Exception
     */
    public function play(ReqGachaPlay $req): void
    {
        // @note このやり方はイマイチ
        //$m_gachas = $this->_App::mst(MstHub::MST_GACHA)->get();
        //$m_gacha = $m_gachas->find($req->gacha_id);
        //if (!$m_gacha->validate()) {
        //    throw $this->_Except::app(TypeExcept::ModelDataNotFound);
        //}
        //
        //$rep_gacha = $this->_Domain::rep(RepHub::REP_GACHA);
        //$ent_gacha = $rep_gacha->find($req->user_id);
        //
        //$result_lots = $this->_Domain::svc(SvcHub::SVC_GACHA)->draw($m_gacha);

        // TODO vo
        //$vo_gacha = $this->_Domain::vo(VoHub::VO_M_GACHA)->find($req->gacha_id);
        // @note 基底処理にする
        $vo_gacha = $this->_Domain::mstVo(VoHub::VO_M_GACHA)->find($req->gacha_id);
        $rep_item = $this->_Domain::rep(RepHub::REP_ITEM);
        $ent_item = $rep_item->find($req->user_id, $vo_gacha->cost_id);
        if ($ent_item->isEmpty()) {
            dd('$ent_item->isEmpty()');
        }

        // @note コストが足りるか確認
        if (!$vo_gacha->validateCost($ent_item->amount)) {
            // TODO エラー出力
            dd('!validateCost');
        }
        $ent_item->subAmount($vo_gacha->total_cost_amount);
        $rep_item->persist($ent_item);

        // TODO 内部で validate のエラーをしてるので、どうするか決める
        $svc_gacha = $this->_Domain::svc(SvcHub::SVC_GACHA);
        $svc_gacha_result = $svc_gacha->draw($req->user_id, $req->gacha_id);

        // @note $svc_gacha_result より present_box の処理


        //$service_item = $this->_Domain::svc(SvcHub::SVC_ITEM);


//        $ent_gacha->addExecCount();
//        dd($ent_gacha->_vp_u_gacha_info->_exec_count);


        //$item_id = $ent_gacha->costItemId();
        //$ent_item = Rep(EntHub::ITEM)->find($user_id, $item_id);
        //if (!$ent_gacha->validCost($ent_item->amount)) {
        //    throw $this->_Except::app('ガチャのコスト足りないエラー');
        //}
        //$ent_item->sub($ent_gacha->costAmount());
        //$rep_item->persist($ent_item);
        //
        //$result = $ent_gacha->lot();
    }
}
