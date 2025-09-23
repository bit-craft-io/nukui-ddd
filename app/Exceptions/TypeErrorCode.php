<?php

namespace App\Exceptions;

enum TypeErrorCode: int
{
    case app_user_not_found = 1001;

    public function message(): string
    {
        return match($this) {
            self::app_user_not_found => 'User not found',
        };
    }
}
