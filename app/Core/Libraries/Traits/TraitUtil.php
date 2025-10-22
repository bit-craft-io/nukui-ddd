<?php

declare(strict_types=1);

namespace App\Core\Libraries\Traits;

use App\Core\Libraries\Stateless\StlUtil;

trait TraitUtil
{
    /**
     * @return string|StlUtil
     */
    protected function _util(): string|StlUtil
    {
        return StlUtil::class;
    }
}
