<?php

declare(strict_types=1);

namespace App\Domains;

use App\Domains\Item\EntItem;
use App\Domains\Account\EntAccount;
use App\Domains\User\EntUser;

final class EntHub
{
    const string ENT_ACCOUNT = EntAccount::class;
    const string ENT_USER = EntUser::class;
    const string ENT_ITEM = EntItem::class;
}
