<?php

declare(strict_types=1);

namespace App\Http\Applications;

use App\Core\Http\Applications\BaseApp;
use App\Core\Http\Requests\ReqNone;
use App\Domains\RepHub;

class AppItem extends BaseApp
{
    /**
     * @param ReqNone $req
     * @return void
     */
    public function get(ReqNone $req): void
    {
        $rep_item = $this->_Domain::rep(RepHub::REP_ITEM);
        $ent_items = $rep_item->getByUserId($req->user_id);
        $items = [];
        foreach ($ent_items as $entItem) {
            $items[] = $entItem->toArray();
        }
        $this->_ResponseParam::set('items', $items);
    }
}
