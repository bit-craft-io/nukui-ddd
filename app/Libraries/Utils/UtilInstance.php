<?php

declare(strict_types=1);

namespace App\Libraries\Utils;

final class UtilInstance
{
    protected static ?object $_prototype = null;

    /**
     * @template T
     * @param T $class
     * @return T
     */
    public static function prototype($class, bool $is_singleton = false)
    {
        if (!app()->has($class)) {
            app()->singleton($class);
            self::$_prototype = app($class);
            if (method_exists(self::$_prototype, 'setDefaults')) {
                self::$_prototype->setDefaults();
            }
        }
        if ($is_singleton) {
            return self::$_prototype;
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
