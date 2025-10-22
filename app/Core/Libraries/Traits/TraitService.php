<?php

declare(strict_types=1);

namespace App\Core\Libraries\Traits;

use App\Core\Libraries\Stateless\Static\StlStaService;

trait TraitService
{
    public string|StlStaService $_service = StlStaService::class;
}
