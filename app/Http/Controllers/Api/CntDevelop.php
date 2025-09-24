<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Applications\Api\AppDevelop;
use App\Http\Controllers\BaseCnt;
use App\Http\Requests\Api\Develop\ReqDevelopItemAdd;
use App\Http\Responses\Core\ResponseConfig;
use App\Http\Responses\ResNone;

class CntDevelop extends BaseCnt
{
    public function itemAdd(AppDevelop $app, ReqDevelopItemAdd $req): void
    {
        ResponseConfig::modifyResponse(ResNone::class);
        $app->itemAdd($req);
    }
}
