<?php

declare(strict_types=1);

namespace App\Core\Libraries\Traits;

use App\Core\Libraries\Stateful\Static\StfStaCache;
use App\Core\Libraries\Stateless\Static\StlStaApplication;
use App\Core\Libraries\Stateless\Static\StlStaConfig;
use App\Core\Libraries\Stateless\Static\StlStaDate;
use App\Core\Libraries\Stateless\Static\StlStaLog;

trait TraitApplication
{
    public string|StfStaCache $_Cache = StfStaCache::class;
    public string|StlStaApplication $_App = StlStaApplication::class;
    public string|StlStaConfig $_Config = StlStaConfig::class;
    public string|StlStaDate $_Date = StlStaDate::class;
    public string|StlStaLog $_Log = StlStaLog::class;
}
