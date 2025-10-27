<?php

declare(strict_types=1);

namespace App\Core\Libraries\Traits;

use App\Core\Libraries\Stateless\Static\StlStaDomain;

trait TraitDomain
{
    public string|StlStaDomain $_Domain = StlStaDomain::class;
}
