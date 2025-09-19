<?php

declare(strict_types=1);

namespace App\Libraries\Utils;

final class UtilGlobals
{
    protected static array $_globals = [];

    public static function set(string $key, $value): void
    {
        self::$_globals[$key] = $value;
    }

    public static function find(string $key): mixed
    {
        if (isset(self::$_globals[$key])) {
            return self::$_globals[$key];
        }
        return null;
    }
}
