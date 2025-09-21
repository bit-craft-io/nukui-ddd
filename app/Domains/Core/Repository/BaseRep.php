<?php

declare(strict_types=1);

namespace App\Domains\Core\Repository;

use App\Libraries\Traits\TraitDataSource;
use App\Libraries\Traits\TraitEntity;

abstract class BaseRep
{
    use TraitDataSource;
    use TraitEntity;
}
