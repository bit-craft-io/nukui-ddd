<?php

declare(strict_types=1);

namespace App\Core\Libraries\Traits;

use App\Core\Libraries\Stateless\Static\StlStaApplication;

trait TraitApplication
{
    public string|StlStaApplication $_App = StlStaApplication::class;
}
