<?php

declare(strict_types=1);

namespace App\Core\Libraries\Stateless\Static;

use App\Core\Exceptions\Enum\TypeExcept;
use App\Core\Exceptions\ExceptApp;
use App\Core\Exceptions\ExceptModel;
use App\Core\Libraries\Stateful\Static\StfStaFactory;

final class StlStaExcept
{
    /**
     * @param TypeExcept $type_except
     * @param array $except_params
     * @return ExceptApp
     */
    public static function app(TypeExcept $type_except, array $except_params = []): ExceptApp
    {
        $class = StfStaFactory::new(ExceptApp::class);
        $class->init($type_except, $except_params);
        return $class;
    }

    /**
     * @param TypeExcept $type_except
     * @param array $except_params
     * @return ExceptModel
     */
    public static function model(TypeExcept $type_except, array $except_params = []): ExceptModel
    {
        $class = StfStaFactory::new(ExceptModel::class);
        $class->init($type_except, $except_params);
        return $class;
    }
}
