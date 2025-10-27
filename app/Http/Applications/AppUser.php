<?php

declare(strict_types=1);

namespace App\Http\Applications;

use App\Core\Http\Applications\BaseApp;
use App\Core\Http\Requests\ReqNone;
use App\Domains\RepHub;

class AppUser extends BaseApp
{
    public function info(ReqNone $req): void
    {
        $repUser = $this->_Domain::rep(RepHub::REP_USER);
        $entUser = $repUser->findByUserId($req->user_id);
        $this->_ResponseParam::set('user_info', $entUser->getProperties());
    }
}
