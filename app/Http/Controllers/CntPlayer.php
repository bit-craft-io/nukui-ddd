<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Applications\AppPlayer;
use App\Http\Requests\ReqNone;
use App\Http\Responses\ResDevNone;

class CntPlayer extends BaseCnt
{
    /**
     * @param AppPlayer $app
     * @param ReqNone $req
     * @return void
     */
    public function find(AppPlayer $app, ReqNone $req): void
    {
        //$this->_response()->modify(ResPlayableFind::class);
        $this->_response()->modify(ResDevNone::class);
        $params = $req->collect()->toArray();
        $app->find($params);
    }

    /**
     * @param AppPlayer $app
     * @param ReqNone $req
     * @return void
     */
    public function search(AppPlayer $app, ReqNone $req): void
    {
        $this->_response()->modify(ResDevNone::class);
        $params = $req->collect()->toArray();
        $app->search_type_b($params);
    }
}
