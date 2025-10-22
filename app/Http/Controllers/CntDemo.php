<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Core\Http\Controllers\BaseCnt;
use App\Core\Http\Requests\ReqNone;
use App\Core\Http\Responses\ResNone;
use App\Http\Applications\AppDemo;

class CntDemo extends BaseCnt
{
    //use TraitLog

    public function case01(AppDemo $app, ReqNone $req): void
    {
        $this->_response()->modify::set(ResNone::class);
        $app->case01([]);
    }
}
