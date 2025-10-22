<?php

declare(strict_types=1);

namespace App\Core\Libraries\Traits;

use App\Core\Libraries\Stateful\Static\StfStaFactory;
use App\Core\Libraries\Stateful\StfResponse;

trait TraitResponse
{
    /**
     * @return StfResponse
     */
    protected function _response(): StfResponse
    {
        return StfStaFactory::singleton(StfResponse::class);
    }
}
