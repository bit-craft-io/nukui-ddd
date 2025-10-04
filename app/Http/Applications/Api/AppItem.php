<?php

declare(strict_types=1);

namespace App\Http\Applications\Api;

use App\Domains\Reps;
use App\Http\Applications\Core\BaseApp;
use App\Http\Requests\Core\ReqNone;

class AppItem extends BaseApp
{
    public function get(ReqNone $req): void
    {
        $repItem = $this->_rep(Reps::REP_ITEM);
        $entItems = $repItem->getByUserId($req->user_id);
        $entItem = $entItems->find(1);
        dd($entItems->find(1));
    }

    public function dummy(array $params): void
    {
        dd(__LINE__);
    }
}
