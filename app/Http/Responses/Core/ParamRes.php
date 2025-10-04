<?php

namespace App\Http\Responses\Core;

final class ParamRes
{
    private static array $_param = [];

    public static function set(string $key, $value): void
    {
        self::$_param[$key] = $value;
    }

    public static function all(): array
    {
        return self::$_param;
    }

    public static function find(string $key)
    {
        return self::$_param[$key] ?? null;
    }
}
