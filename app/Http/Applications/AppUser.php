<?php

declare(strict_types=1);

namespace App\Http\Applications;

use App\Core\Http\Applications\BaseApp;
use App\Core\Http\Requests\ReqNone;
use App\Domains\Rep;

class AppUser extends BaseApp
{
    public function info(ReqNone $req): void
    {
        $repUser = $this->_rep(Rep::REP_USER);
        $entUser = $repUser->findByUserId($req->user_id);
        $entUser->addEnergy(1);
    }
}
