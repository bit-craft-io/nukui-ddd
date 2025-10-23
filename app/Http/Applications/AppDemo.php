<?php

declare(strict_types=1);

namespace App\Http\Applications;

use App\Core\Http\Applications\BaseApp;
use App\Core\Http\Responses\ResNone;

class AppDemo extends BaseApp
{
    public function case01(array $req): void
    {
        // @note レスポンスクラスを変更
        //       MdlResponse
        $this->_res_modify::set(ResNone::class);
    }
}
