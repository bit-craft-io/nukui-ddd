<?php

declare(strict_types=1);

namespace App\Http\Applications;

use App\Core\Http\Applications\BaseApp;

class AppDemo extends BaseApp
{
    public function case01(array $req): void
    {
        // @note レスポンスクラスを変更
        //       MdlResponse
        //$this->_responseModifySet(ResNone::class);
    }
}
