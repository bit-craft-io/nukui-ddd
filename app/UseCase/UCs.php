<?php

namespace App\UseCase;

use App\UseCase\Account\UcCreateApiToken;
use App\UseCase\Account\UcMakeEmail;
use App\UseCase\Account\UcMakePublicId;

class UCs
{
    const string UC_MAKE_EMAIL = UcMakeEmail::class;
    const string UC_MAKE_PUBLIC_ID = UcMakePublicId::class;
    const string UC_CREATE_API_TOKEN = UcCreateApiToken::class;
}
