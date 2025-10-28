<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Core\Http\Controllers\BaseCnt;
use App\Core\Http\Requests\ReqNone;
use App\Core\Http\Responses\ResSuccess;
use App\Http\Applications\AppItem;

class CntItem extends BaseCnt
{
    public function get(AppItem $app, ReqNone $req): void
    {
        $this->_ResponseModify::set(ResSuccess::class);
        $app->get($req);
    }
}
