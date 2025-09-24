<?php

declare(strict_types=1);

namespace App\Libraries\Traits;

use App\Libraries\Utils\UtilInstance;

trait TraitUseCase
{
    /**
     * @template T
     * @param T $use_case_class
     * @return T
     */
    public function _useCase(string $use_case_class)
    {
        return UtilInstance::singleton($use_case_class);
    }
}
