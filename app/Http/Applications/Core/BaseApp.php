<?php

declare(strict_types=1);

namespace App\Http\Applications\Core;

use App\Libraries\Traits\TraitException;
use App\Libraries\Traits\TraitRepository;
use App\Libraries\Traits\TraitTransaction;
use App\Libraries\Traits\TraitUseCase;
use App\Libraries\Traits\TraitValueObject;

abstract class BaseApp
{
    use TraitTransaction;
    use TraitRepository;
    use TraitValueObject;
    use TraitUseCase;
    use TraitException;
}
