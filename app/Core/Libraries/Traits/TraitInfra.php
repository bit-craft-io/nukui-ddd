<?php

declare(strict_types=1);

namespace App\Core\Libraries\Traits;

use App\Core\Libraries\Stateful\StfInfra;

trait TraitInfra
{
    public string|StfInfra $_infra = StfInfra::class;
}
