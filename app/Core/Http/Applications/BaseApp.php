<?php

declare(strict_types=1);

namespace App\Core\Http\Applications;

use App\Core\Libraries\Traits\TraitDevelop;
use App\Core\Libraries\Traits\TraitException;
use App\Core\Libraries\Traits\TraitRepository;
use App\Core\Libraries\Traits\TraitResponse;
use App\Core\Libraries\Traits\TraitTransaction;
use App\Core\Libraries\Traits\TraitUseCase;
use App\Core\Libraries\Traits\TraitValueObject;

abstract class BaseApp
{
    use TraitTransaction;
    use TraitRepository;
    use TraitValueObject;
    use TraitUseCase;
    use TraitException;
    use TraitResponse;

    use TraitDevelop;
}
