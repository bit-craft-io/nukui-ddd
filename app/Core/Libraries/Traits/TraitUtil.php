<?php

declare(strict_types=1);

namespace App\Core\Libraries\Traits;

use App\Core\Libraries\Stateless\Static\StlStaUtilCompress;
use App\Core\Libraries\Stateless\Static\StlStaUtilRandom;

trait TraitUtil
{
    public string|StlStaUtilCompress $_UtilCompress = StlStaUtilCompress::class;
    public string|StlStaUtilRandom $_UtilRandom = StlStaUtilRandom::class;
}
