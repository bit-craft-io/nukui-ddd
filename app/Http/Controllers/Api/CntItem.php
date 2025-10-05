<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Core\Http\Controllers\BaseCnt;
use App\Core\Http\Requests\ReqNone;
use App\Http\Applications\Api\AppItem;

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
