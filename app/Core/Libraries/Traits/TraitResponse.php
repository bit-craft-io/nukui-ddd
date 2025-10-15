<?php

declare(strict_types=1);

namespace App\Core\Libraries\Traits;

use App\Core\Libraries\Stateful\Instance\StfInsResponseModify;
use App\Core\Libraries\Stateful\Instance\StfInsResponseParam;
use App\Core\Libraries\Stateful\Static\StfStaInstance;

trait TraitResponse
{
    /**
     * @return StfInsResponseParam
     */
    protected function _param(): StfInsResponseParam
    {
        return StfStaInstance::singleton(StfInsResponseParam::class);
    }

    /**
     * @return StfInsResponseModify
     */
    protected function _modify(): StfInsResponseModify
    {
        return StfStaInstance::singleton(StfInsResponseModify::class);
    }
}
