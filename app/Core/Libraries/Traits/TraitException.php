<?php

declare(strict_types=1);

namespace App\Core\Libraries\Traits;

use App\Core\Exceptions\Enums\TypeExcept;
use App\Core\Exceptions\ExceptApp;
use App\Core\Exceptions\ExceptModel;
use App\Core\Libraries\Stateful\Static\StfStaFactory;

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
        return StfStaFactory::new($except_type);
    }
}
