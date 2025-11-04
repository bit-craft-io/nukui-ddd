<?php

declare(strict_types=1);

namespace App\Core\Libraries\Traits;

use App\Core\Libraries\Stateful\Static\StfStaCache;
use App\Core\Libraries\Stateless\Static\StlStaApplication;

trait TraitApplication
{
    public string|StlStaApplication $_App = StlStaApplication::class;
    public string|StfStaCache $_Cache = StfStaCache::class;
}
