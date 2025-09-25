<?php

declare(strict_types=1);

namespace App\Http\Applications;

use App\Libraries\Traits\TraitTransaction;
use App\Libraries\Traits\TraitRepository;
use App\Libraries\Traits\TraitValueObject;
use App\Libraries\Traits\TraitUseCase;
use App\Libraries\Traits\TraitException;

abstract class BaseApp
{
    use TraitTransaction;
    use TraitRepository;
    use TraitValueObject;
    use TraitUseCase;
    use TraitException;
}
