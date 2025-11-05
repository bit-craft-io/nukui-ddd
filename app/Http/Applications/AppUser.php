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
        $rep_user = $this->_Domain::rep(RepHub::REP_USER);
        $ent_user = $rep_user->findByUserId($req->user_id);
        $this->_ResponseParam::set('user_info', $ent_user->toArray());
    }
}
