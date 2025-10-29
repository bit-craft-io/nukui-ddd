<?php

declare(strict_types=1);

namespace App\Http\Applications;

use App\Core\Exceptions\Enums\TypeExcept;
use App\Core\Http\Applications\BaseApp;
use App\Core\Http\Requests\ReqNone;
use App\DataSources\DsHub;
use App\Domains\RepHub;
use App\Http\Requests\Gacha\ReqGachaPlay;

class AppGacha extends BaseApp
{
    public function get(ReqNone $req): void
    {
        //$ent_gacha = $this->_Domain::rep(RepHub::REP_GACHA)->find($req->user_id);
        //$this->_ResponseParam::set('u_gacha_info', $ent_gacha->uGachaInfo());
    }

    public function play(ReqGachaPlay $req): void
    {
        $dvMGachas = $this->_Domain::rep(RepHub::REP_GACHA)->getVoMGacha();
        foreach ($dvMGachas as $dvMGacha) {

        }


        $ent_gacha = $this->_Domain::rep(RepHub::REP_GACHA)->find($req->user_id);
        if (!$ent_gacha->validMaster($req->gacha_id)) {
            throw $this->_Except::app(TypeExcept::ModelDataNotFound);
        }

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
