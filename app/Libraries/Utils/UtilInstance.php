<?php

declare(strict_types=1);

namespace App\Libraries\Utils;

final class UtilInstance
{
    protected static ?array $_prototype = null;
    /** @var array<object>|null  */
    protected static ?array $_singleton = null;

    /**
     * @template T
     * @param T $class
     * @return T
     */
    public static function new($class)
    {
        return app($class);
    }

    /**
     * @template T
     * @param T $class
     * @return T
     */
    public static function prototype($class, bool $is_singleton = false)
    {
        if (!app()->has($class)) {
            app()->singleton($class);
            self::$_singleton[$class] = app($class);
            if (method_exists(self::$_singleton[$class], 'setDefaults')) {
                self::$_singleton[$class]->setDefaults();
            }
            self::$_prototype[$class] = clone self::$_singleton[$class];
        }
        if ($is_singleton) {
            return self::$_singleton[$class];
        }
        return clone self::$_prototype[$class];
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

    ///**
    // * @return UtilIterator
    // */
    //public static function iterator(): UtilIterator
    //{
    //    return self::prototype(UtilIterator::class);
    //}
}
