<?php

namespace App\Core\Libraries\Stateful;

use App\Core\Libraries\Stateful\Static\StfStaFactory;

final class StfService
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
