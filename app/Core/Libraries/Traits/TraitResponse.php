<?php

declare(strict_types=1);

namespace App\Core\Libraries\Traits;

use App\Core\Libraries\Stateful\Static\StfStaFactory;
use App\Core\Libraries\Stateless\StlResponse;

trait TraitResponse
{
    /**
     * @return StlResponse
     */
    protected function _response(): StlResponse
    {
        return StfStaFactory::singleton(StlResponse::class);
    }
}
