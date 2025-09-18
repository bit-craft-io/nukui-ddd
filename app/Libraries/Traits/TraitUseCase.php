<?php

declare(strict_types=1);

namespace App\Libraries\Traits;

use App\Libraries\Utils\UtilInstance;
use App\UseCase\UcCreateApiToken;
use App\UseCase\UcMakeEmail;
use App\UseCase\UcMakePublicId;

trait TraitUseCase
{
    const string UC_MAKE_EMAIL = UcMakeEmail::class;
    const string UC_MAKE_PUBLIC_ID = UcMakePublicId::class;
    const string UC_CREATE_API_TOKEN = UcCreateApiToken::class;

    /**
     * @template T
     * @param T $use_case
     * @return T
     */
    public function _useCase(string $use_case)
    {
        return UtilInstance::singleton($use_case);
    }
}
