<?php

declare(strict_types=1);

namespace App\Libraries\Traits;

use App\Domains\VOs\VoPrimaryCode;
use App\Libraries\Utils\UtilInstance;

trait TraitValueObject
{
    const string VO_PRIMARY_CODE = VoPrimaryCode::class;

    /**
     * @template T
     * @param T $vo
     * @return T
     */
    public function _vo(string $vo)
    {
        return UtilInstance::prototype($vo);
    }
}
