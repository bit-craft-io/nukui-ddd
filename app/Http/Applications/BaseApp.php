<?php

declare(strict_types=1);

namespace App\Http\Applications;

use App\Libraries\Shared\SharedHelper;
use App\Libraries\Traits\Useful;

class BaseApp
{
    use Useful;

    /**
     * @template T
     * @param T $repository
     * @return T
     */
    protected function _rep(string $repository)
    {
        return SharedHelper::singleton($repository);
    }
}
