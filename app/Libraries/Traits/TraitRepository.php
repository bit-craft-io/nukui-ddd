<?php

declare(strict_types=1);

namespace App\Libraries\Traits;

use App\Domains\Reps;
use App\Libraries\Utils\UtilInstance;

trait TraitRepository
{
    /**
     * @template T
     * @param T $repository_class
     * @return T
     */
    protected function _rep(string $repository_class)
    {
        return UtilInstance::singleton($repository_class);
    }
}
