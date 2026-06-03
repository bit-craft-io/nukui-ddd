<?php

declare(strict_types=1);

namespace App\Core\Libraries\Traits;

use App\Core\Libraries\Stateless\Static\StlStaUtilCompress;
use App\Core\Libraries\Stateless\Static\StlStaUtilNanoId;

trait TraitUtil
{
    public string|StlStaUtilCompress $_UtilCompress = StlStaUtilCompress::class;
    public string|StlStaUtilNanoId $_UtilNanoId = StlStaUtilNanoId::class;
}
