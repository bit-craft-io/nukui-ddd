<?php

declare(strict_types=1);

namespace App\Core\Libraries\Stateless\Static;

use App\Core\Libraries\Stateful\Instance\StfInsIterator;
use App\Core\Libraries\Stateful\Static\StfStaFactory;
use Illuminate\Database\Eloquent\Collection;

final class StlStaDomain
{
    /**
     * @template T
     * @param T $repository_class
     * @return T
     */
    public static function rep(string $repository_class)
    {
        return StfStaFactory::singleton($repository_class);
    }

    /**
     * @template T
     * @param T $entity_class
     * @return T
     */
    public static function ent(string $entity_class)
    {
        return StfStaFactory::prototype($entity_class);
    }

    /**
     * @template T
     * @param T $vo_class
     * @return T
     */
    public static function vo(string $vo_class)
    {
        return StfStaFactory::prototype($vo_class);
    }

    /**
     * @param callable $callable
     * @param Collection $models
     * @param string $key_name
     * @return StfInsIterator
     */
    public static function iterator(callable $callable, Collection $models, string $key_name = 'id'): StfInsIterator
    {
        $class = StfStaFactory::prototype(StfInsIterator::class);
        $class->init($callable, $models, $key_name);
        return $class;
    }
}
