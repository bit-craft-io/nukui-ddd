<?php

namespace App\Core\Libraries\Traits;

use App\Core\Libraries\Stateful\Static\StfStaFactory;
use App\Core\Libraries\Stateless\StlDevelop;

trait TraitDevelop
{
    /**
     * @return StlDevelop
     */
    protected function _dev(): StlDevelop
    {
        return StfStaFactory::singleton(StlDevelop::class);
    }
}
