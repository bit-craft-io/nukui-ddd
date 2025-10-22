<?php

declare(strict_types=1);

namespace App\Core\Libraries\Stateless;

use App\Core\Libraries\Stateless\Static\StlStaCompress;
use App\Core\Libraries\Stateless\Static\StlStaRandom;

final class StlUtil
{
    public string|StlStaCompress $compress = StlStaCompress::class;
    public string|StlStaRandom $random = StlStaRandom::class;
}
