<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Applications\AppRoot;
//use App\Http\Requests\Root\ReqPlayableFind;
use App\Http\Responses\Root\ResRootIndex;

class CntRoot extends BaseCnt
{
    /**
     * @param AppRoot $app
     * @param ReqPlayableFind $req
     * @return void
     * @throws ExException
     */
    public function index(AppRoot $app, ReqPlayableFind $req): void
    {
        $this->_response()->modify(ResRootIndex::class);
        $params = $req->collect()->toArray();
        $app->index($params);
    }
}
