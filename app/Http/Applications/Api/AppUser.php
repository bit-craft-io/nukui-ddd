<?php

declare(strict_types=1);

namespace App\Http\Applications\Api;

use App\Domains\Reps;
use App\Http\Applications\BaseApp;
use App\Http\Requests\ReqNone;

class AppUser extends BaseApp
{
    public function info(ReqNone $req): void
    {
        $repUser = $this->_rep(Reps::REP_USER);
        $entUser = $repUser->findByUserId($req->user_id);
        dd($entUser->getEnergy());
        dd(__LINE__);
    }
}
