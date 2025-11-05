<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Core\Http\Controllers\BaseCnt;
use App\Core\Http\Requests\ReqNone;
use App\Http\Applications\AppGacha;
use App\Http\Requests\Gacha\ReqGachaPlay;
use App\Http\Responses\Gacha\ResGachaGet;
use Exception;

class CntGacha extends BaseCnt
{
    /**
     * @param AppGacha $app
     * @param ReqNone $req
     * @return void
     */
    public function get(AppGacha $app, ReqNone $req): void
    {
        $this->_ResponseModify::set(ResGachaGet::class);
        $app->get($req);
    }

    /**
     * @param AppGacha $app
     * @param ReqGachaPlay $req
     * @return void
     * @throws Exception
     */
    public function play(AppGacha $app, ReqGachaPlay $req): void
    {
        $app->play($req);
    }
}
