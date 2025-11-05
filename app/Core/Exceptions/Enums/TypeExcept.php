<?php

declare(strict_types=1);

namespace App\Core\Exceptions\Enums;

enum TypeExcept: int
{
    case ModelDataNotFound = 100;

    case AppUserNotFound = 1001;
    case AppItemNotHave = 2001;
    case AppItemNotEnoughUnits = 2002;
    case AppGachaItemIsEmpty = 3001;
    case AppGachaCostIsNotEnough = 3002;
    case AppGachaMasterIsNotValid = 3003;
    case AppGachaStepNotEqual = 3004;

    public function message(array $except_params = []): string
    {
        return match ($this) {
            self::ModelDataNotFound => 'Data not found',
            self::AppUserNotFound => 'User not found',
            self::AppItemNotHave => 'Item not have',
            self::AppItemNotEnoughUnits => 'Item not enough units',
            self::AppGachaItemIsEmpty => 'Item is empty',
            self::AppGachaCostIsNotEnough => 'Cost is not enough',
            self::AppGachaMasterIsNotValid => 'Master is not valid [gacha.id #1]',
            self::AppGachaStepNotEqual => strtr('Step is not equal [gacha.exec_count #1 != #2]', $except_params),
        };
    }
}
