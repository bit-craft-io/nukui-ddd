<?php

declare(strict_types=1);

namespace App\Core\Exceptions\Enums;

enum TypeExcept: int
{
    case ModelDataNotFound = 100;
    case AppUserNotFound = 1001;
    public function message(): string
    {
        return match($this) {
            self::ModelDataNotFound => 'Data not found',
            self::AppUserNotFound => 'User not found',
        };
    }
}
