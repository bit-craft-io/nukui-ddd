<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Applications\AppPlayable;
use App\Http\Requests\Playable\ReqPlayableFind;
use App\Http\Requests\Playable\ReqPlayableSearch;
use App\Http\Requests\ReqNone;
use App\Http\Responses\ResDevNone;
use Exception;

class CntPlayable extends BaseCnt
{
    /**
     * @param AppPlayable $app
     * @param ReqNone $req
     * @return void
     * @throws Exception
     */
    public function find(AppPlayable $app, ReqNone $req): void
    {
        //$this->_response()->modify(ResPlayableFind::class);
        $params = $req->collect()->toArray();
        $app->find($params);
    }

    /**
     * @param AppPlayable $app
     * @param ReqNone $req
     * @return void
     * @throws Exception
     */
    public function search(AppPlayable $app, ReqNone $req): void
    {
        $this->_response()->modify(ResDevNone::class);
        $params = $req->collect()->toArray();
        //$app->search_type_a($params);
        //$app->search_type_b($params);
        $app->search_type_c($params);
    }
}
