<?php

declare(strict_types=1);

namespace App\Core\Libraries\Stateless\Static;

use App\Core\Exceptions\Enums\TypeExcept;
use App\Core\Exceptions\ExceptApp;
use App\Core\Exceptions\ExceptModel;
use App\Core\Libraries\Stateful\Static\StfStaFactory;

final class StlStaExcept
{
//    public const Code = TypeExcept::class;
//
//    /**
//     * @return class-string<TypeExcept>
//     */
//    public static function code()
//    {
//        return TypeExcept::class;
//    }
//    public static function appUserNotFound(): TypeExcept
//    {
//        return TypeExcept::AppUserNotFound;
//    }

    /**
     * @param TypeExcept $type_except
     * @return ExceptApp
     */
    public static function app(TypeExcept $type_except): ExceptApp
    {
        $class = StfStaFactory::new(ExceptApp::class);
        $class->init($type_except);
        return $class;
    }

    /**
     * @param TypeExcept $type_except
     * @return ExceptModel
     */
    public static function model(TypeExcept $type_except): ExceptModel
    {
        $class = StfStaFactory::new(ExceptModel::class);
        $class->init($type_except);
        return $class;
    }
}
