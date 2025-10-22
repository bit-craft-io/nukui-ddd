<?php

declare(strict_types=1);

namespace App\Core\Libraries\Stateful;

use App\Core\Libraries\Stateful\Static\StfStaResponseModify;
use App\Core\Libraries\Stateful\Static\StfStaResponseParam;

final class StfResponse
{
    public string|StfStaResponseParam $param = StfStaResponseParam::class;
    public string|StfStaResponseModify $modify = StfStaResponseModify::class;
}
