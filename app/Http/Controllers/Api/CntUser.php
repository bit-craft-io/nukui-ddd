<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Applications\Api\AppUser;
use App\Http\Controllers\Core\BaseCnt;
use App\Http\Requests\Core\ReqNone;
use App\Http\Responses\Core\ResNone;
use App\Http\Responses\Core\ResponseConfig;

class CntUser extends BaseCnt
{
    public function info(AppUser $app, ReqNone $req): void
    {
        ResponseConfig::modifyResponse(ResNone::class);
        $app->info($req);
    }
}
