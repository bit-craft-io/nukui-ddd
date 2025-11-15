<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Core\Http\Controllers\BaseCnt;
use App\Http\Applications\AppAccount;
use App\Http\Requests\Account\ReqAccountLogin;
use App\Http\Responses\Account\ResAccountLogin;
use App\Http\Responses\Account\ResAccountRegister;

class CntAccount extends BaseCnt
{
    /**
     * @param AppAccount $app
     * @return void
     */
    public function register(AppAccount $app): void
    {
        $this->_ResponseModify::set(ResAccountRegister::class);
        $app->register();
    }

    /**
     * @param AppAccount $app
     * @param ReqAccountLogin $req
     * @return void
     */
    public function login(AppAccount $app, ReqAccountLogin $req): void
    {
        $this->_ResponseModify::set(ResAccountLogin::class);
        $app->login($req);
    }
}
