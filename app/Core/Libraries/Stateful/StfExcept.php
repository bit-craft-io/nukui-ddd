<?php

declare(strict_types=1);

namespace App\Core\Libraries\Stateful;

use App\Core\Exceptions\Enums\TypeExcept;
use App\Core\Exceptions\ExceptApp;
use App\Core\Exceptions\ExceptModel;

final class StfExcept
{
    /**
     * @param TypeExcept $type_except
     * @return ExceptApp
     */
    public static function app(TypeExcept $type_except): ExceptApp
    {
        $class = Static\StfStaFactory::new(ExceptApp::class);
        $class->init($type_except);
        return $class;
    }

    /**
     * @param TypeExcept $type_except
     * @return ExceptModel
     */
    public static function model(TypeExcept $type_except): ExceptModel
    {
        $class = Static\StfStaFactory::new(ExceptModel::class);
        $class->init($type_except);
        return $class;
    }
}
