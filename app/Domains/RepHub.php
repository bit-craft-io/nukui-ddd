<?php

declare(strict_types=1);

namespace App\Domains;

use App\Domains\Account\RepAccount;
use App\Domains\Gacha\RepGacha;
use App\Domains\Item\RepItem;
use App\Domains\User\RepUser;

final class RepHub
{
    const string REP_ACCOUNT = RepAccount::class;
    const string REP_USER = RepUser::class;
    const string REP_ITEM = RepItem::class;
    const string REP_GACHA = RepGacha::class;
}
