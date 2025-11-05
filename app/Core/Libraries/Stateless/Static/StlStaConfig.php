<?php

declare(strict_types=1);

namespace App\Core\Libraries\Stateless\Static;

use App\Core\Libraries\Stateless\Static\Interface\IStlStaConfigCore;

final class StlStaConfig
{
    /**
     * @return IStlStaConfigCore|object
     */
    public static function core(): mixed
    {
        return (object)config('core');
    }
}
