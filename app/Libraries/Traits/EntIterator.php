<?php

namespace App\Libraries\Traits;

use App\Libraries\Shared\SharedHelper;
use App\Libraries\Shared\SharedIterator;

trait EntIterator
{
    /**
     * @return SharedIterator
     */
    protected function _entIterator(): SharedIterator
    {
        return SharedHelper::prototype(SharedIterator::class);
    }
}
