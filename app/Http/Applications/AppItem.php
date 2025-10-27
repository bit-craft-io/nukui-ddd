<?php

declare(strict_types=1);

namespace App\Http\Applications;

use App\Core\Exceptions\Enums\TypeExcept;
use App\Core\Http\Applications\BaseApp;
use App\Core\Http\Requests\ReqNone;
use App\Domains\RepHub;

class AppItem extends BaseApp
{
    public function get(ReqNone $req): void
    {
        $repItem = $this->_Domain::rep(RepHub::REP_ITEM);
        $entItems = $repItem->getByUserId($req->user_id);
        $items = [];
        foreach ($entItems as $entItem) {
            $items[] = $entItem->toArray();
        }
        $this->_ResponseParam::set('items', $items);
    }
}
