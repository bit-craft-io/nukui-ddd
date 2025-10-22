<?php

declare(strict_types=1);

namespace App\Core\Libraries\Traits;

use App\Core\Libraries\Stateful\Static\StfStaFactory;

trait TraitValueObject
{
    /**
     * @template T
     * @param T $vo_class
     * @return T
     */
    public function _vo(string $vo_class)
    {
        return StfStaFactory::prototype($vo_class);
    }
}
