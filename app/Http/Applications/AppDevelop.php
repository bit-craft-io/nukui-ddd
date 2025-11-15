<?php

declare(strict_types=1);

namespace App\Http\Applications;

use App\Core\Exceptions\Enum\TypeExcept;
use App\Core\Http\Applications\BaseApp;
use App\Domains\Item\VoHub;
use App\Domains\RepHub;
use App\Http\Requests\Develop\ReqDevelopItemAdd;
use App\Http\Requests\Develop\ReqDevelopItemSub;
use Exception;

class AppDevelop extends BaseApp
{
    /**
     * @param ReqDevelopItemAdd $req
     * @return void
     * @throws Exception
     */
    public function itemAdd(ReqDevelopItemAdd $req): void
    {
        $rep_item = $this->_Domain::rep(RepHub::REP_ITEM);
        $ent_item = $rep_item->find($req->user_id, $req->item_id);
        if ($ent_item->isEmpty()) {
            $ent_item = $rep_item->makeDraft($req->user_id, $req->item_id);
        }

        $vo_item = $this->_Domain::mstVo(VoHub::VO_M_ITEM)->find($req->item_id);
        $ent_item->end_at($vo_item->end_at);
        $sum_amount = $vo_item->clampToMaxStock($ent_item->amount + $req->amount);

        $ent_item->amount($sum_amount);
        $rep_item->persist($ent_item);

        // @note 更新の結果を Response する場合
        //$this->_ResponseParam::set('item', $ent_item->toArray());
    }

    /**
     * @param ReqDevelopItemSub $req
     * @return void
     * @throws Exception
     */
    public function itemSub(ReqDevelopItemSub $req): void
    {
        $rep_item = $this->_Domain::rep(RepHub::REP_ITEM);
        $ent_item = $rep_item->find($req->user_id, $req->item_id);
        if ($ent_item->isEmpty()) {
            throw $this->_Except::app(TypeExcept::AppItemNotHave);
        }

        if (!$ent_item->hasAmount($req->amount)) {
            throw $this->_Except::app(TypeExcept::AppItemNotEnoughUnits);
        }

        $ent_item->subAmount($req->amount);
        $rep_item->persist($ent_item);

        // @note 更新の結果を Response する場合
        //$this->_ResponseParam::set('item', $ent_item->toArray());
    }
}
