<?php

namespace App\Core\Libraries\Stateless\Static;

use App\Core\Libraries\Stateful\Static\StfStaFactory;

final class StlStaService
{
    /**
     * @template T
     * @param T $use_case_class
     * @return T
     */
    public static function uc(string $use_case_class)
    {
        return StfStaFactory::singleton($use_case_class);
    }
}
