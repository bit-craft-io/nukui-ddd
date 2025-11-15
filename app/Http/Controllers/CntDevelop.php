<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Core\Http\Controllers\BaseCnt;
use App\Core\Http\Responses\ResSuccess;
use App\Http\Applications\AppDevelop;
use App\Http\Requests\Develop\ReqDevelopItemAdd;
use App\Http\Requests\Develop\ReqDevelopItemSub;
use Exception;

class CntDevelop extends BaseCnt
{
    /**
     * @param AppDevelop $app
     * @param ReqDevelopItemAdd $req
     * @return void
     * @throws Exception
     */
    public function itemAdd(AppDevelop $app, ReqDevelopItemAdd $req): void
    {
        $this->_ResponseModify::set(ResSuccess::class);
        $app->itemAdd($req);
    }

    /**
     * @param AppDevelop $app
     * @param ReqDevelopItemSub $req
     * @return void
     * @throws Exception
     */
    public function itemSub(AppDevelop $app, ReqDevelopItemSub $req): void
    {
        $this->_ResponseModify::set(ResSuccess::class);
        $app->itemSub($req);
    }
}
