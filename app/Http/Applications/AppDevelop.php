<?php

declare(strict_types=1);

namespace App\Http\Applications;

use App\Core\Http\Applications\BaseApp;
use App\Domains\RepHub;
use App\Http\Requests\Develop\ReqDevelopItemAdd;

class AppDevelop extends BaseApp
{
    public function itemAdd(ReqDevelopItemAdd $req): void
    {
        $repItem = $this->_Domain::rep(RepHub::REP_ITEM);
        $entItemIte = $repItem->getByUserId($req->user_id);
        $entItem = $entItemIte->find($req->item_id);
        if (!$entItem) {
            $entItem = $repItem->makeDraft($req->user_id, $req->item_id);
            $entItem->end_at($entItem->getEnabledEndAt());
        }
        $entItem->addAmount($req->amount);
        $repItem->persist($entItem);
    }
}
