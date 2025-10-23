<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Core\Http\Controllers\BaseCnt;
use App\Core\Http\Requests\ReqNone;
use App\Core\Http\Responses\ResNone;
use App\Http\Applications\AppUser;

class CntUser extends BaseCnt
{
    public function info(AppUser $app, ReqNone $req): void
    {
        $this->_res_modify::set(ResNone::class);
        $app->info($req);
    }
}
