<?php

declare(strict_types=1);

namespace App\Core\Libraries\Traits;

use App\Core\Libraries\Stateful\Static\StfStaFactory;

trait TraitRepository
{
    /**
     * @template T
     * @param T $repository_class
     * @return T
     */
    protected function _rep(string $repository_class)
    {
        return StfStaFactory::singleton($repository_class);
    }
}
