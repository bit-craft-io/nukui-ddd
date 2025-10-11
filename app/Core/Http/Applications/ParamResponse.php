<?php

declare(strict_types=1);

namespace App\Core\Http\Applications;

final class ParamResponse
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
