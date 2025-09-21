<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Applications\Api\AppAccount;
use App\Http\Controllers\BaseCnt;
use App\Http\Requests\Api\Account\ReqAccountLogin;
use App\Http\Requests\ReqNone;

class CntAccount extends BaseCnt
{
    public function register(AppAccount $app, ReqNone $req): void
    {
        $app->register($req->params());
    }

    public function login(AppAccount $app, ReqAccountLogin $req): void
    {
        $app->login($req->params());
    }

    public function dummy(AppAccount $app, ReqNone $req): void
    {
        $app->dummy($req->params());
    }
}
