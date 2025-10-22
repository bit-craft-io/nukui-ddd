<?php

declare(strict_types=1);

namespace App\Core\Http\Applications;

use App\Core\Libraries\Traits\TraitDevelop;
use App\Core\Libraries\Traits\TraitDomain;
use App\Core\Libraries\Traits\TraitException;
use App\Core\Libraries\Traits\TraitResponse;
use App\Core\Libraries\Traits\TraitTransaction;
use App\Core\Libraries\Traits\TraitService;
use App\Core\Libraries\Traits\TraitUtil;

abstract class BaseApp
{
    use TraitTransaction;
    use TraitException;
    use TraitResponse;
    use TraitDevelop;
    use TraitDomain;
    use TraitService;
    use TraitUtil;
}
