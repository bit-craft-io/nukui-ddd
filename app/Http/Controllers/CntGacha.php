<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Core\Http\Controllers\BaseCnt;
use App\Core\Http\Requests\ReqNone;
use App\Http\Applications\AppGacha;
use App\Http\Requests\Gacha\ReqGachaPlay;
use App\Http\Responses\Gacha\ResGachaGet;

class CntGacha extends BaseCnt
{
    public function get(AppGacha $app, ReqNone $req): void
    {
        $this->_ResponseModify::set(ResGachaGet::class);
        $app->get($req);
    }

    public function play(AppGacha $app, ReqGachaPlay $req): void
    {
        $app->play($req);
    }
}
