<?php

declare(strict_types=1);

namespace App\Core\Http\Controllers;

use App\Core\Http\Requests\ReqNone;
use App\Core\Libraries\Traits\TraitResponse;

abstract class BaseCnt
{
    use TraitResponse;

    // @note コンストラクタインジェクションが無いメソッドの場合でも
    //       ミドルウェアで ReqNone を取得可能にする為
    public function __construct(ReqNone $req)
    {
    }
}
