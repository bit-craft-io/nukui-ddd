<?php

declare(strict_types=1);

namespace App\Core\Libraries\Traits;

use App\Core\Libraries\Stateful\Static\StfStaTransaction;

trait TraitTransaction
{
    public string|StfStaTransaction $_Transaction = StfStaTransaction::class;
}
