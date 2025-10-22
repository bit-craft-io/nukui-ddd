<?php

declare(strict_types=1);

namespace App\Core\Libraries\Traits;

use App\Core\Libraries\Stateful\StfExcept;

trait TraitException
{
    public string|StfExcept $_except = StfExcept::class;
}
