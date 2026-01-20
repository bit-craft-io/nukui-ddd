<?php

declare(strict_types=1);

namespace App\Core\Http\Applications;

use App\Core\Libraries\Traits\TraitDomain;
use App\Core\Libraries\Traits\TraitInfra;
use App\Core\Libraries\Traits\TraitCore;
use App\Core\Libraries\Traits\TraitDevelop;
use App\Core\Libraries\Traits\TraitResponse;
use App\Core\Libraries\Traits\TraitUtil;

abstract class BaseApp
{
    use TraitCore;
    use TraitUtil;
    use TraitInfra;
    use TraitDomain;
    use TraitResponse;

    use TraitDevelop;
}
