<?php

declare(strict_types=1);

namespace App\Http\Applications;

use App\Core\Http\Applications\BaseApp;
use App\Domains\RepHub;
use App\Http\Requests\Develop\ReqDevelopItemAdd;
use App\Http\Requests\Develop\ReqDevelopItemSub;

class AppDevelop extends BaseApp
{
    public function itemAdd(ReqDevelopItemAdd $req): void
    {
        $rep_item = $this->_Domain::rep(RepHub::REP_ITEM);

        $ent_items = $rep_item->getByUserId($req->user_id);
        $ent_item = $ent_items->find($req->item_id);
        if (!$ent_item) {
            $ent_item = $rep_item->makeDraft($req->user_id, $req->item_id);
            $ent_item->end_at($ent_item->getMItemEndAt());
        }

        // TODO WIP この処理はDicクラスで処理
        //$sum_amount = $rep_item->getVoMItem()->find($req->item_id)->getSumAmount($ent_item->amount + $req->amount);
        //$ent_item->addAmount($sum_amount);
        //$rep_item->persist($ent_item);
    }

    public function itemSub(ReqDevelopItemSub $req): void
    {
        $rep_item = $this->_Domain::rep(RepHub::REP_ITEM);

        $ent_items = $rep_item->getByUserId($req->user_id);
        $ent_item = $ent_items->find($req->item_id);
        if (!$ent_item) {
            $ent_item = $rep_item->makeDraft($req->user_id, $req->item_id);
            $ent_item->end_at($ent_item->getMItemEndAt());
        }

        $ent_item->subAmount($req->amount);
        $rep_item->persist($ent_item);
    }
}
