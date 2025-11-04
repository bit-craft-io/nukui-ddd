<?php

declare(strict_types=1);

namespace App\Core\Libraries\Stateful\Static;

use Illuminate\Cache\CacheManager;
use Illuminate\Contracts\Cache\Repository;
use Illuminate\Support\Facades\Cache;

final class StfStaCache
{
    public static function array(): Repository
    {
        return Cache::store('array');
    }

    public static function redis(): Repository
    {
        return Cache::store('redis');
    }
}
