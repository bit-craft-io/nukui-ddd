<?php

declare(strict_types=1);

namespace App\Core\Libraries\Traits;

use App\Core\Libraries\Stateful\Static\StfStaResponseModify;
use App\Core\Libraries\Stateful\Static\StfStaResponseParam;

trait TraitResponse
{
    public string|StfStaResponseParam $_ResponseParam = StfStaResponseParam::class;
    public string|StfStaResponseModify $_ResponseModify = StfStaResponseModify::class;
}
