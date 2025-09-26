<?php

declare(strict_types=1);

namespace App\Libraries\Traits;

use App\Exceptions\Enums\TypeExcept;
use App\Exceptions\ExceptApp;
use App\Exceptions\ExceptModel;
use App\Libraries\Utils\UtilInstance;

trait TraitException
{
    const string EXCEPT_TYPE_APP = ExceptApp::class;
    const string EXCEPT_TYPE_MODEL = ExceptModel::class;
    public static string $error_code = TypeExcept::class;

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
