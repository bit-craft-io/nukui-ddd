<?php

declare(strict_types=1);

namespace App\Core\Libraries\Traits;

use App\Core\Libraries\Stateful\Static\StfStaInstance;

trait TraitUseCase
{
    /**
     * @template T
     * @param T $use_case_class
     * @return T
     */
    public function _useCase(string $use_case_class)
    {
        return StfStaInstance::singleton($use_case_class);
    }
}
