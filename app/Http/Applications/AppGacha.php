<?php

declare(strict_types=1);

namespace App\Http\Applications;

use App\Core\Exceptions\Enums\TypeExcept;
use App\Core\Http\Applications\BaseApp;
use App\Core\Http\Requests\ReqNone;
use App\Domains\Gacha\Service\SvcGacha;
use App\Domains\RepHub;
use App\Domains\SvcHub;
use App\Http\Requests\Gacha\ReqGachaPlay;
use App\Master\MstHub;

class AppGacha extends BaseApp
{
    public function get(ReqNone $req): void
    {
    }

    public function play(ReqGachaPlay $req): void
    {
        $m_gachas = $this->_App::mst(MstHub::MST_GACHA)->getIterator();
        $m_gacha = $m_gachas->find($req->gacha_id);
        if (!$m_gacha->validate()) {
            throw $this->_Except::app(TypeExcept::ModelDataNotFound);
        }

        $rep_gacha = $this->_Domain::rep(RepHub::REP_GACHA);
        $ent_gacha = $rep_gacha->find($req->user_id);

        $result_lots = $this->_Domain::svc(SvcHub::SVC_GACHA_LOT)->draw($m_gacha);
        //dd($m_gacha->type_draw, __LINE__);
//        $result_lots = match(true) {
//            $m_gacha->type_draw->isNormal() => $svc_gacha_lot->normal($req->gacha_id),
//            $m_gacha->type_draw->isStep() => $svc_gacha_lot->step($req->gacha_id),
//            $m_gacha->type_draw->isFixed() => $svc_gacha_lot->fixed($req->gacha_id),
//        };

        $ent_gacha->addExecCount();
        dd($ent_gacha->_vp_u_gacha_info->_exec_count);

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
