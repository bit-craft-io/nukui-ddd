<?php

declare(strict_types=1);

namespace App\Http\Applications\UseCase;

use App\Http\Applications\UseCase\Account\UcCreateApiToken;
use App\Http\Applications\UseCase\Account\UcMakeEmail;
use App\Http\Applications\UseCase\Account\UcMakePublicId;

class UC
{
    const string UC_ACCOUNT_MAKE_EMAIL = UcMakeEmail::class;
    const string UC_ACCOUNT_MAKE_PUBLIC_ID = UcMakePublicId::class;
    const string UC_ACCOUNT_CREATE_API_TOKEN = UcCreateApiToken::class;
}
