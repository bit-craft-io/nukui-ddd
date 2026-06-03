<?php

declare(strict_types=1);

namespace App\Http\Applications\UseCase;

use App\Http\Applications\UseCase\Account\UcCreateApiToken;
use App\Http\Applications\UseCase\Account\UcMakeEmail;
use App\Http\Applications\UseCase\Account\UcMakePrimaryCode;

final class UcHub
{
    // TODO 20260408
    const string UC_ACCOUNT_MAKE_EMAIL = UcMakeEmail::class;
    const string UC_ACCOUNT_MAKE_PRIMARY_CODE = UcMakePrimaryCode::class;
    const string UC_ACCOUNT_CREATE_API_TOKEN = UcCreateApiToken::class;
}
