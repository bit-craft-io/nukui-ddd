<?php

declare(strict_types=1);

namespace App\Core\Domains\Repository;

use App\Core\Libraries\Traits\TraitDomain;
use App\Core\Libraries\Traits\TraitInfra;

abstract class BaseRep
{
    use TraitDomain;
    use TraitInfra;
}
