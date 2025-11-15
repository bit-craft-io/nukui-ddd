<?php

declare(strict_types=1);

namespace App\Core\Libraries\Traits;

use App\Core\Libraries\Stateless\Static\StlStaExcept;

trait TraitException
{
    public string|StlStaExcept $_Except = StlStaExcept::class;
}
