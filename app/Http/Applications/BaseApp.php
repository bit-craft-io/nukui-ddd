<?php

declare(strict_types=1);

namespace App\Http\Applications;

use App\Libraries\Traits\TraitRepository;
use App\Libraries\Traits\TraitUseCase;

abstract class BaseApp
{
    use TraitRepository;
    use TraitUseCase;
}
