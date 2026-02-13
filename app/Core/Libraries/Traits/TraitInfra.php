<?php

declare(strict_types=1);

namespace App\Core\Libraries\Traits;

use App\Core\Libraries\Stateful\Static\StfStaCache;
use App\Core\Libraries\Stateful\Static\StfStaDataSource;
use App\Core\Libraries\Stateful\Static\StfStaTransaction;
use App\Core\Libraries\Stateless\Static\StlStaConfig;

trait TraitInfra
{
    public string|StfStaCache $_Cache = StfStaCache::class;
    public string|StlStaConfig $_Config = StlStaConfig::class;
    public string|StfStaDataSource $_DataSource = StfStaDataSource::class;
    public string|StfStaTransaction $_Transaction = StfStaTransaction::class;
}
