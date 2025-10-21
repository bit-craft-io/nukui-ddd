<?php

declare(strict_types=1);

namespace App\Core\Libraries\Stateful\Static;

final class StfStaResponseParam
{
    protected static array $_param = [];

    public static function set(string $key, $value): void
    {
        self::$_param[$key] = $value;
    }

    public static function get(): array
    {
        return self::$_param;
    }

    public static function find(string $key)
    {
        return self::$_param[$key] ?? null;
    }
}
