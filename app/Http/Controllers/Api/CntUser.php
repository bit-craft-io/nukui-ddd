<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Applications\Api\AppItem;
use App\Http\Applications\Api\AppUser;
use App\Http\Controllers\BaseCnt;
use App\Http\Requests\ReqNone;
use App\Http\Responses\Core\ResponseConfig;
use App\Http\Responses\ResNone;

class CntUser extends BaseCnt
{
    public function info(AppUser $app, ReqNone $req): void
    {
        ResponseConfig::modifyResponse(ResNone::class);
        $app->info($req);
    }
}
