<?php

declare(strict_types=1);

namespace App\Domains;

use App\DataSources\BaseDs;
use App\Libraries\Shared\SharedHelper;
use App\Libraries\Shared\SharedIterator;
use App\Libraries\Traits\DataSource;
use App\Libraries\Traits\EntIterator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

abstract class BaseRep
{
    //use DataSource;
    //use EntIterator;

    protected ?BaseEnt $_worker_ent = null;
    protected ?object $_ds = null;
    protected ?string $_ds_type = null;

    /**
     * @param ?Model $model
     * @return BaseEnt
     */
    //protected function _ent(array $arguments = []): object
    protected function _ent(?Model $model): BaseEnt
    {
        $called_class_name = last(explode('\\', static::class));
        $class_prefix = Str::studly(last(explode('_', Str::snake($called_class_name))));
        $class_name = "App\Domains\\{$class_prefix}\\Ent{$class_prefix}";
        /** @var BaseEnt $ent */
        $ent = SharedHelper::prototype($class_name);
        if (method_exists($ent, 'setFromModel')) {
            // @note プロパティを設定
            $ent->setFromModel($model);
        }
        return $ent;
    }

    /**
     * @param Collection $models
     * @return SharedIterator
     */
    protected function _ents(Collection $models): SharedIterator
    {
        // @note シングルトンにするとメモリを使いまわす為、
        //  複数同時に_entsを使用できない為、プロトタイプパターンで解決
        $ent_iterator = SharedHelper::prototype(SharedIterator::class);
        $ent_iterator->init([$this, 'worker'], $models);
        return $ent_iterator;
    }

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

    /**
     * @param ?Model $model
     * @return BaseEnt
     */
    public function reCreate(?Model $model): BaseEnt
    {
        // @note $arguments は連想配列ではない為、配列の最初を直接取得
        //  スコープが限定的の為、reset で取得
        $properties = reset($model);
        return $this->_ent($properties);
    }

    /**
     * @param ?Model $model
     * @return BaseEnt
     */
    public function worker(?Model $model): BaseEnt
    {
        if (!$this->_worker_ent) {
            $this->_worker_ent = $this->_ent(null);
        }

        $this->_worker_ent->initEnt();
        $this->_worker_ent->setFromModel($model);
        return $this->_worker_ent;
    }

    /**
     * @return BaseDs
     */
    public function ds(): BaseDs
    {
        if (!$this->_ds) {
            $this->_ds = $this->_ds($this->_ds_type);
        }
        return $this->_ds;
    }
}
