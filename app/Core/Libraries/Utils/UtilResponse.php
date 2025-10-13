<?php

declare(strict_types=1);

namespace App\Core\Libraries\Utils;

final class UtilResponse
{
    private static array $_param = [];

    public static function param(string $key, $value): void
    {
        self::$_param[$key] = $value;
    }

    public static function _params(): array
    {
        return self::$_param;
    }

    public static function _param(string $key)
    {
        return self::$_param[$key] ?? null;
    }
}
