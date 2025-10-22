<?php

declare(strict_types=1);

namespace App\Core\Libraries\Traits;

use App\Core\Libraries\Stateless\StlDevelop;

trait TraitDevelop
{
    /**
     * @return string|StlDevelop
     */
    protected function _dev(): string|StlDevelop
    {
        return StlDevelop::class;
    }
}
