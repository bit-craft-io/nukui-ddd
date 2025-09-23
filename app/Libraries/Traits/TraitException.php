<?php

namespace App\Libraries\Traits;

use App\Exceptions\AppException;
use App\Exceptions\ModelException;
use App\Exceptions\TypeErrorCode;
use App\Libraries\Utils\UtilInstance;

trait TraitException
{
    const string EXCEPT_TYPE_APP = AppException::class;
    const string EXCEPT_TYPE_MODEL = ModelException::class;
    public static string $error_code = TypeErrorCode::class;

    /**
     * @template T
     * @param T $except_type
     * @return T
     */
    protected function _except(string $except_type)
    {
        return UtilInstance::new($except_type);
    }
}
