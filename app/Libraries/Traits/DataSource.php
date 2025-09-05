<?php

namespace App\Libraries\Traits;

use App\Libraries\Shared\SharedHelper;

trait DataSource
{
    /**
     * @template T
     * @param string<T> $data_source_name
     * @return T
     */
    protected function _ds(string $data_source_name)
    {
        $model_class_name = preg_replace('/^Ds/', '', class_basename($data_source_name));
        $model_name = "App\\Models\\$model_class_name";
        $instance = SharedHelper::prototype($data_source_name);
        $instance->_model(SharedHelper::singleton($model_name));
        return $instance;
    }
}
