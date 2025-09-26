<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Applications\Api\AppItem;
use App\Http\Controllers\Core\BaseCnt;
use App\Http\Requests\Core\ReqNone;

class CntItem extends BaseCnt
{
    public function get(AppItem $app, ReqNone $req): void
    {
        $app->get($req);
    }

    public function dummy(AppItem $app, ReqNone $req): void
    {
        dd(__LINE__);
    }
}
