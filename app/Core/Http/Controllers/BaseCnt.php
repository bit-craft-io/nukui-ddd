<?php

declare(strict_types=1);

namespace App\Core\Http\Controllers;

use App\Core\Libraries\Traits\TraitResponse;

abstract class BaseCnt
{
    use TraitResponse;

    // @note コンストラクタインジェクションで BaseReq が無い場合
    //       BaseReq の prepareForValidation が実行されて無い為
    //       ミドルウェアで request->user_id は null になる
    //       但し、__construct で call すると冗長になる
    //public function __construct(ReqNone $req)
    //{
    //}
}
