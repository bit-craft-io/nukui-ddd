<?php

declare(strict_types=1);

namespace App\Domains;

use App\Domains\Account\RepAccount;
use App\Domains\Item\RepItem;
use App\Domains\User\RepUser;

final class Rep
{
    const string REP_ACCOUNT = RepAccount::class;
    const string REP_USER = RepUser::class;
    const string REP_ITEM = RepItem::class;
}
