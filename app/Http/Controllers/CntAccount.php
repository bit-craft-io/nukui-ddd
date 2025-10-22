<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Core\Http\Controllers\BaseCnt;
use App\Core\Http\Requests\ReqNone;
use App\Core\Http\Responses\ResNone;
use App\Http\Applications\AppAccount;
use App\Http\Requests\Account\ReqAccountLogin;

class CntAccount extends BaseCnt
{
    public function register(AppAccount $app, ReqNone $req): void
    {
        $app->register($req);
    }

    public function login(AppAccount $app, ReqAccountLogin $req): void
    {
        $app->login($req);
    }

    public function dummy(AppAccount $app, ReqNone $req): void
    {
        // @note Responseのクラスを変更
        $this->_response()->modify::set(ResNone::class);
        $app->dummy($req);
    }
}
