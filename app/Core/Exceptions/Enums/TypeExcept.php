<?php

declare(strict_types=1);

namespace App\Core\Exceptions\Enums;

enum TypeExcept: int
{
    case ModelDataNotFound = 100;

    case AppUserNotFound = 1001;
    case AppGachaItemIsEmpty = 3001;
    case AppGachaCostIsNotEnough = 3002;
    case AppGachaMasterIsNotValid = 3003;
    case AppGachaStepNotEqual = 3004;

    public function message(): string
    {
        return match ($this) {
            self::ModelDataNotFound => 'Data not found',
            self::AppUserNotFound => 'User not found',
            self::AppGachaItemIsEmpty => 'Item is empty',
            self::AppGachaCostIsNotEnough => 'Cost is not enough',
            self::AppGachaMasterIsNotValid => 'Master is not valid',
            self::AppGachaStepNotEqual => 'Step is not equal',
        };
    }
}
