<?php

declare(strict_types=1);

namespace App\Core\Libraries\Traits;

use App\Core\Libraries\Stateful\StfService;

trait TraitService
{
    public string|StfService $_service = StfService::class;
}
