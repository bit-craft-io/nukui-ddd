<?php

declare(strict_types=1);

namespace App\Core\Libraries\Stateless\Static;

use App\Core\Libraries\Stateful\Instance\StfInsIterator;
use App\Core\Libraries\Stateful\Static\StfStaFactory;

final class StlStaDictionary
{
    /**
     * @template T of object
     * @param class-string<T> $dict_class
     * @param string $key
     * @return StfInsIterator<T>|array<T>
     */
    public static function iterator(string $dict_class, string $key = 'id')
    {
        $dict_class = StfStaFactory::prototype($dict_class);
        $collection = $dict_class->getEnable();
        return $dict_class->iterator($collection, $key);
    }
}
