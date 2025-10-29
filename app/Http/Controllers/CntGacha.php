<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Core\Http\Controllers\BaseCnt;
use App\Core\Http\Requests\ReqNone;
use App\Http\Applications\AppGacha;
use App\Http\Requests\Gacha\ReqGachaPlay;

class CntGacha extends BaseCnt
{
    public function get(AppGacha $app, ReqNone $req): void
    {
        $app->get($req);
    }

    public function play(AppGacha $app, ReqGachaPlay $req): void
    {
        $app->play($req);
    }
}
