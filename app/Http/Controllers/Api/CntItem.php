<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Applications\Api\AppItem;
use App\Http\Controllers\BaseCnt;
use App\Http\Requests\ReqNone;

class CntItem extends BaseCnt
{
    public function get(AppItem $app, ReqNone $req)
    {
        $app->get($req);
    }

    public function dummy(AppItem $app, ReqNone $req)
    {
        dd(__LINE__);
    }
}
