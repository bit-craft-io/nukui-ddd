<?php

declare(strict_types=1);

namespace App\Core\Libraries\Traits;

use App\Core\Libraries\Stateful\Static\StfStaInstance;
use App\Core\Libraries\Stateless\StlResponseBuilder;

trait TraitResponse
{
    /**
     * @return StlResponseBuilder
     */
    protected function _response(): StlResponseBuilder
    {
        return StfStaInstance::singleton(StlResponseBuilder::class);
    }
}
