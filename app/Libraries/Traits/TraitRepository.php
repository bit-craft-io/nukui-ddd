<?php

declare(strict_types=1);

namespace App\Libraries\Traits;

use App\Domains\Account\RepAccount;
use App\Domains\User\RepUser;
use App\Libraries\Utils\UtilInstance;

trait TraitRepository
{
    const string REP_ACCOUNT = RepAccount::class;
    const string REP_USER = RepUser::class;

    /**
     * @template T
     * @param T $repository
     * @return T
     */
    protected function _rep(string $repository)
    {
        return UtilInstance::singleton($repository);
    }
}
