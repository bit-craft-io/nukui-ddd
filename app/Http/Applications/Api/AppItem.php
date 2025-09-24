<?php

declare(strict_types=1);

namespace App\Http\Applications\Api;

use App\Domains\Reps;
use App\Http\Applications\BaseApp;
use App\Http\Requests\ReqNone;

class AppItem extends BaseApp
{
    public function get(ReqNone $req): void
    {
        // TODO テスト用にfind（１件）
        //  本来はｎ件
        //$entItem = $this->_rep(Reps::REP_ITEM)->findByUserId($req->user_id);
        //dd($req->user_id, $entItem->item_id);

        // TODO イテレータパターン
        $entItems = $this->_rep(Reps::REP_ITEM)->getByUserId($req->user_id);
        $entItem = $entItems->find(1);
        dd($entItems->find(1));
    }

    public function dummy(array $params): void
    {
        dd(__LINE__);
    }
}
