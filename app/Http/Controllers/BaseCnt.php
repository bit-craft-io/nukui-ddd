<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Libraries\Response;
use App\Libraries\Shared\SharedHelper;

class BaseCnt
{
    protected function _response(): Response
    {
        return SharedHelper::singleton(Response::class);
    }
}
