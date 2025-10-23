<?php

declare(strict_types=1);

namespace App\Core\Libraries\Traits;

use App\Core\Libraries\Stateless\Static\StlStaCompress;
use App\Core\Libraries\Stateless\Static\StlStaRandom;

trait TraitUtil
{
    public string|StlStaCompress $_UtilCompress = StlStaCompress::class;
    public string|StlStaRandom $_UtilRandom = StlStaRandom::class;
}
