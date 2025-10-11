<?php

declare(strict_types=1);

namespace App\Core\Domains\Repository;

use App\Core\Libraries\Traits\TraitDataSource;
use App\Core\Libraries\Traits\TraitEntity;

abstract class BaseRep
{
    use TraitDataSource;
    use TraitEntity;
}
