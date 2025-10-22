<?php

declare(strict_types=1);

namespace App\Core\Libraries\Stateful;

use App\Core\Libraries\Stateful\Static\StfStaFactory;

final class StfDomain
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
}
