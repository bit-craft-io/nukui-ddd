<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Core\Http\Controllers\BaseCnt;
use App\Core\Http\Responses\ResSuccess;
use App\Http\Applications\AppIdle;
use App\Http\Requests\Idle\ReqIdleSync;

class CntIdle extends BaseCnt
{
    /**
     * @param AppIdle $app
     * @param ReqIdleSync $req
     * @return void
     */
    public function sync(AppIdle $app, ReqIdleSync $req): void
    {
        $this->_ResponseModify::set(ResSuccess::class);
        $app->sync($req);
    }
}
