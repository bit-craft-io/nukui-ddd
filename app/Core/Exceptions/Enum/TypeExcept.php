<?php

declare(strict_types=1);

namespace App\Core\Exceptions\Enum;

enum TypeExcept: int
{
    case ModelDataNotFound = 11001;

    case AppNotOkStatus = 21001;
    case AppUserNotFound = 22001;
    case AppItemNotHave = 23001;
    case AppItemNotEnoughUnits = 23002;
    case AppGachaItemIsEmpty = 24001;
    case AppGachaCostIsNotEnough = 24002;
    case AppGachaMasterIsNotValid = 24003;
    case AppGachaExecCountOver = 24004;
    case AppGachaStepNotEqual = 24005;

    case DevelopNoneProtoBuf = 99001;
    case DevelopFailedForwardGameServer = 99002;

    public function message(array $except_params = []): string
    {
        return match ($this) {
            self::ModelDataNotFound => 'Data not found',
            self::AppNotOkStatus => 'Not Ok Status',
            self::AppUserNotFound => 'User not found',
            self::AppItemNotHave => 'Item not have',
            self::AppItemNotEnoughUnits => 'Item not enough units',
            self::AppGachaItemIsEmpty => 'Item is empty',
            self::AppGachaCostIsNotEnough => 'Cost is not enough',
            self::AppGachaMasterIsNotValid => strtr('Master is not valid [gacha.id #1]', $except_params),
            self::AppGachaExecCountOver => strtr('Exec count over [gacha.group_no #1]', $except_params),
            self::AppGachaStepNotEqual => strtr('Step is not equal [step m #1 != u #2]', $except_params),
            self::DevelopNoneProtoBuf => strtr('develop none proto buf [proto #1]', $except_params),
            self::DevelopFailedForwardGameServer => strtr('develop failed forward game server [status #1 body #2]', $except_params),
        };
    }
}
