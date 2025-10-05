<?php

declare(strict_types=1);

namespace App\Core\Libraries\Traits;

use App\Core\DataSources\BaseDs;
use App\Core\Libraries\Utils\UtilInstance;
use Illuminate\Database\Eloquent\Model;

trait TraitDataSource
{
    private static ?array $_instances = null;

    /**
     * @template T
     * @param T $data_source_class
     * @return T
     */
    protected function _ds(string $data_source_class)
    {
        $instance = self::$_instances[$data_source_class] ?? null;
\Log::emergency(json_encode($instance));
        if ($instance) {
            return $instance;
        }

        $model_class_name = preg_replace('/^Ds/', '', class_basename($data_source_class));
        $model_name = "App\\Models\\$model_class_name";

        /** @var BaseDs $instance */
        $instance = UtilInstance::singleton($data_source_class);

        /** @var Model $model */
        $model = UtilInstance::singleton($model_name);

        $instance->_model($model);

        self::$_instances[$data_source_class] = $instance;

        return $instance;
    }
}
