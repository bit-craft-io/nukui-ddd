<?php

declare(strict_types=1);

namespace App\Core\Libraries\Stateful;

use App\Core\DataSources\BaseDs;
use Illuminate\Database\Eloquent\Model;

final class StfInfra
{
    private static ?array $_instances = null;

    /**
     * @template T
     * @param T $data_source_class
     * @return T
     */
    public static function ds(string $data_source_class)
    {
        $instance = self::$_instances[$data_source_class] ?? null;
        if ($instance) {
            return $instance;
        }

        $model_class_name = preg_replace('/^Ds/', '', class_basename($data_source_class));
        $model_name = "App\\Models\\$model_class_name";

        /** @var BaseDs $instance */
        $instance = Static\StfStaFactory::singleton($data_source_class);

        /** @var Model $model */
        $model = Static\StfStaFactory::singleton($model_name);

        $instance->_model($model);

        self::$_instances[$data_source_class] = $instance;

        return $instance;
    }
}
