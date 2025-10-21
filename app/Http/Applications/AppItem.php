<?php

declare(strict_types=1);

namespace App\Http\Applications;

use App\Core\Http\Applications\BaseApp;
use App\Core\Http\Requests\ReqNone;
use App\Domains\Rep;

class AppItem extends BaseApp
{
    public function get(ReqNone $req): void
    {
        $repItem = $this->_rep(Rep::REP_ITEM);
        $entItems = $repItem->getByUserId($req->user_id);
        $entItem = $entItems->find(1);
        $this->_response()->param::set('item', $entItem->getProperties());
    }

    public function dummy(array $params): void
    {
        dd(__LINE__);
    }
}
