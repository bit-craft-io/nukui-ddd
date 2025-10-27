<?php

declare(strict_types=1);

namespace App\_Demo\Domains;

use App\Domains\Item\EntItem;
use App\Domains\Account\EntAccount;
use App\Domains\User\EntUser;

final class EntHub
{
    const string ENT_DEMO_ITEM = EntItem::class;
}
