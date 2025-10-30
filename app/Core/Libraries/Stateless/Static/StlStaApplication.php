<?php

declare(strict_types=1);

namespace App\Core\Libraries\Stateless\Static;

use App\Core\Libraries\Stateful\Static\StfStaFactory;

final class StlStaApplication
{
    /**
     * @template T of object
     * @param class-string<T> $master_class
     * @return T
     */
    public static function mst(string $master_class): object
    {
        return StfStaFactory::singleton($master_class);
    }
}
