<?php

declare(strict_types=1);

namespace App\Core\Libraries\Traits;

use App\Core\Libraries\Stateful\Static\StfStaInfra;

trait TraitInfrastructure
{
    public string|StfStaInfra $_Infra = StfStaInfra::class;
}
