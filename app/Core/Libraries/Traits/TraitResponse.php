<?php

declare(strict_types=1);

namespace App\Core\Libraries\Traits;

use App\Core\Libraries\Stateful\StfResponse;

trait TraitResponse
{
    /**
     * @return string|StfResponse
     */
    protected function _response(): string|StfResponse
    {
        return StfResponse::class;
    }
}
