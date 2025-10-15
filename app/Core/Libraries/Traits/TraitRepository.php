<?php

declare(strict_types=1);

namespace App\Core\Libraries\Traits;

use App\Core\Libraries\Stateful\Static\StfStaInstance;

trait TraitRepository
{
    /**
     * @template T
     * @param T $repository_class
     * @return T
     */
    protected function _rep(string $repository_class)
    {
        return StfStaInstance::singleton($repository_class);
    }
}
