<?php

declare(strict_types=1);

namespace App\Core\Libraries\Traits;

use App\Core\Libraries\Stateless\Static\StlStaDomain;
use App\Core\Libraries\Stateless\Static\StlStaUseCase;

trait TraitDomain
{
    public string|StlStaDomain $_Domain = StlStaDomain::class;
    public string|StlStaUseCase $_UseCase = StlStaUseCase::class;
}
