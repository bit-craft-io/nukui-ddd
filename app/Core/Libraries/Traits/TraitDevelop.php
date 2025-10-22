<?php

declare(strict_types=1);

namespace App\Core\Libraries\Traits;

use App\Core\Libraries\Stateful\Static\StfStaFactory;
use App\Core\Libraries\Stateful\StfDevelop;

trait TraitDevelop
{
    /**
     * @return StfDevelop
     */
    protected function _dev(): StfDevelop
    {
        return StfStaFactory::singleton(StfDevelop::class);
    }
}
