<?php

declare(strict_types=1);

namespace App\Libraries\Shared;

final class SharedHelper
{
    protected static ?object $_prototype = null;

    /**
     * @template T
     * @param T $class
     * @return T
     */
    public static function prototype($class)
    {
        if (!app()->has($class)) {
            app()->singleton($class);
            self::$_prototype = app($class);
        }
        return clone self::$_prototype;
    }

    // TODO string<T>
    // @param string<T> $class

    /**
     * @template T
     * @param T $class
     * @return T
     */
    public static function singleton($class)
    {
        if (!app()->has($class)) {
            app()->singleton($class);
        }
        return app($class);
    }
}
