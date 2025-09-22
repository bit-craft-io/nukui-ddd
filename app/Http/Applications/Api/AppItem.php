<?php

declare(strict_types=1);

namespace App\Http\Applications\Api;

use App\Http\Applications\BaseApp;
use App\Http\Requests\BaseReq;
use App\Http\Requests\ReqNone;

class AppItem extends BaseApp
{
    public function get(ReqNone $req): void
    {
        // TODO テスト用にfind（１件）
        //  本来はｎ件
        $entItem = $this->_rep(self::REP_ITEM)->findByUserId($req->user_id);
        dd($entItem->item_id);

        dd(__LINE__);
    }

    public function dummy(array $params): void
    {
        dd(__LINE__);
    }
}
