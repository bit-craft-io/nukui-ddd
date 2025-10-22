<?php

declare(strict_types=1);

namespace App\Core\Libraries\Traits;

use App\Core\Libraries\Stateful\StfDomain;

trait TraitDomain
{
    public string|StfDomain $_domain = StfDomain::class;
}
