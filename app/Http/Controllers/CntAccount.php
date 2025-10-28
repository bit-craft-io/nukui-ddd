<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Core\Http\Controllers\BaseCnt;
use App\Core\Http\Requests\ReqNone;
use App\Core\Http\Responses\ResSuccess;
use App\Http\Applications\AppAccount;
use App\Http\Requests\Account\ReqAccountLogin;

class CntAccount extends BaseCnt
{
    public function register(AppAccount $app): void
    {
        $app->register();
    }

    public function login(AppAccount $app, ReqAccountLogin $req): void
    {
        $app->login($req);
    }
}
