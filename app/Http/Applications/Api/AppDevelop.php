<?php

declare(strict_types=1);

namespace App\Http\Applications\Api;

use App\Domains\Reps;
use App\Http\Applications\Core\BaseApp;
use App\Http\Requests\Api\Develop\ReqDevelopItemAdd;

class AppDevelop extends BaseApp
{
    public function itemAdd(ReqDevelopItemAdd $req): void
    {
        $repItem = $this->_rep(Reps::REP_ITEM);
        $entItemIte = $repItem->getByUserId($req->user_id);
        $entItem = $entItemIte->find($req->item_id);
        if (!$entItem) {
            $entItem = $repItem->makeDraft($req->user_id, $req->item_id);
            $entItem->enabled_end_at($entItem->getEnabledEndAt());
        }
        $entItem->addAmount($req->amount);
        $repItem->persist($entItem);
    }
}
