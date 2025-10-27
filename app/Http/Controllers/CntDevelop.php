<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Core\Http\Controllers\BaseCnt;
use App\Core\Http\Responses\ResSuccess;
use App\Http\Applications\AppDevelop;
use App\Http\Requests\Develop\ReqDevelopItemAdd;

class CntDevelop extends BaseCnt
{
    public function itemAdd(AppDevelop $app, ReqDevelopItemAdd $req): void
    {
        $this->_ResponseModify::set(ResSuccess::class);
        $app->itemAdd($req);
    }
}
