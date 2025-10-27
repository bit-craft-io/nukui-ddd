<?php

declare(strict_types=1);

namespace App\Core\Libraries\Stateful\Static;

final class StfStaGlobals
{
    private static array $_globals = [];

    /**
     * @param string $key
     * @param $value
     * @return void
     */
    public static function set(string $key, $value): void
    {
        self::$_globals[$key] = $value;
    }

    /**
     * @param string $key
     * @return mixed
     */
    public static function find(string $key): mixed
    {
        if (isset(self::$_globals[$key])) {
            return self::$_globals[$key];
        }
        return null;
    }
}
