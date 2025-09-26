<?php

declare(strict_types=1);

namespace App\Libraries\Traits;

use App\DataSources\Core\BaseDs;
use App\Libraries\Utils\UtilGlobals;
use App\Libraries\Utils\UtilInstance;
use Illuminate\Database\Eloquent\Model;

trait TraitDataSource
{
    /**
     * @template T
     * @param T $data_source_class
     * @return T
     */
    protected function _ds(string $data_source_class)
    {
        $instance = UtilGlobals::find($data_source_class);
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

        UtilGlobals::set($data_source_class, $instance);

        return $instance;
    }
}
