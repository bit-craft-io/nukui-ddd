<?php

declare(strict_types=1);

namespace App\Exceptions;

enum TypeExcept: int
{
    case model_data_not_found = 100;
    case app_user_not_found = 1001;
    public function message(): string
    {
        return match($this) {
            self::model_data_not_found => 'Data not found',
            self::app_user_not_found => 'User not found',
        };
    }
}
