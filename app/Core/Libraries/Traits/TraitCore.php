<?php

declare(strict_types=1);

namespace App\Core\Libraries\Traits;

use App\Core\Libraries\Stateless\Static\StlStaDate;
use App\Core\Libraries\Stateless\Static\StlStaExcept;
use App\Core\Libraries\Stateless\Static\StlStaLog;

trait TraitCore
{
    public string|StlStaDate $_Date = StlStaDate::class;
    public string|StlStaExcept $_Except = StlStaExcept::class;
    public string|StlStaLog $_Log = StlStaLog::class;
}
