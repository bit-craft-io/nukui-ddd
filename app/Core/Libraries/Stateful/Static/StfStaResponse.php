<?php

declare(strict_types=1);

namespace App\Core\Libraries\Stateful\Static;

final class StfStaResponse
{
    const string MODE_RES = 'res';
    const string MODE_MOD = 'mod';

    private static ?string $_mode = null;
    private static array $_param = [];
    private static ?string $_modify = null;

    public static function _mode(string $mode): self
    {
        self::$_mode = $mode;
        return new self();
    }

    public static function _set(string $key = '', $value = null): void
    {
        match(self::$_mode) {
            self::MODE_RES => self::$_param[$key] = $value,
            self::MODE_MOD => self::$_modify = $key,
            default => null,
        };
    }

    public static function get(): array
    {
        return match(self::$_mode) {
            self::MODE_RES => self::$_param,
            default => [],
        };
    }

    public static function find(string $key = null)
    {
        return match(self::$_mode) {
            self::MODE_RES => self::$_param[$key],
            self::MODE_MOD => self::$_modify,
            default => null,
        };
    }
}
