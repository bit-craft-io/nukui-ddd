<?php

declare(strict_types=1);

namespace App\Libraries\Traits;

use App\DataSources\BaseDs;
use App\DataSources\DsAccount;
use App\DataSources\DsUUser;
use App\Libraries\Utils\UtilGlobals;
use App\Libraries\Utils\UtilInstance;
use Illuminate\Database\Eloquent\Model;

trait TraitDataSource
{
    // @note ここにデータソースを追記していく
    const DS_ACCOUNT = DsAccount::class;
    const DS_U_USER = DsUUser::class;

    /**
     * @template T
     * @param T $ds_type
     * @return T
     */
    protected function _ds(string $ds_type)
    {
        $instance = UtilGlobals::find($ds_type);
        if ($instance) {
            return $instance;
        }

        //$model_class_name = preg_replace('/^Ds/', '', class_basename($this->_ds_type));
        $model_class_name = preg_replace('/^Ds/', '', class_basename($ds_type));
        $model_name = "App\\Models\\$model_class_name";

        /** @var BaseDs $instance */
        //$instance = HlpInstance::singleton($this->_ds_type);
        $instance = UtilInstance::singleton($ds_type);

        /** @var Model $model */
        $model = UtilInstance::singleton($model_name);

        $instance->_model($model);

        UtilGlobals::set($ds_type, $instance);

        return $instance;
    }
}
