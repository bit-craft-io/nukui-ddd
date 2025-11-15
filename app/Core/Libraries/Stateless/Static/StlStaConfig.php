<?php

declare(strict_types=1);

namespace App\Core\Libraries\Stateless\Static;

use App\Core\Libraries\Stateless\Static\Interface\IStlStaConfigApp;
use App\Core\Libraries\Stateless\Static\Interface\IStlStaConfigCore;

final class StlStaConfig
{
    /**
     * @return IStlStaConfigApp|object
     */
    public static function app(): mixed
    {
        return (object)config('app');
    }

    /**
     * @return IStlStaConfigCore|object
     */
    public static function core(): mixed
    {
        return (object)config('core');
    }
}
