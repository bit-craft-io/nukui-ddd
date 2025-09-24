<?php

declare(strict_types=1);

namespace App\Http\Applications\Api;

use App\Domains\Reps;
use App\Http\Applications\BaseApp;
use App\Http\Requests\Api\Develop\ReqDevelopItemAdd;

class AppDevelop extends BaseApp
{
    public function itemAdd(ReqDevelopItemAdd $req): void
    {
        $rep = $this->_rep(Reps::REP_ITEM);
        $ents = $rep->getByUserId($req->user_id);
        $ent = $ents->find($req->item_id);
        if (!$ent) {
            $ent = $rep->draft($req->user_id, $req->item_id);
            $ent->enabled_end_at($ent->getEnabledEndAt());
        }
        $ent->addAmount($req->amount);
        $rep->persist($ent);
    }
}
