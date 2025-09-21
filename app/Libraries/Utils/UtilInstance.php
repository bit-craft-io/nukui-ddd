<?php

declare(strict_types=1);

namespace App\Libraries\Utils;

final class UtilInstance
{
    protected static ?object $_prototype = null;
    protected static ?object $_shingleton = null;

    /**
     * @template T
     * @param T $class
     * @return T
     */
    public static function prototype($class, bool $is_singleton = false)
    {
        if (!app()->has($class)) {
            app()->singleton($class);
            self::$_shingleton = app($class);
            if (method_exists(self::$_shingleton, 'setDefaults')) {
                self::$_shingleton->setDefaults();
            }
            self::$_prototype = clone self::$_shingleton;
        }
        if ($is_singleton) {
            return self::$_shingleton;
        }
        return clone self::$_prototype;
    }

    /**
     * @template T
     * @param T $class
     * @return T
     */
    public static function singleton($class)
    {
        return self::prototype($class, true);
    }
}
