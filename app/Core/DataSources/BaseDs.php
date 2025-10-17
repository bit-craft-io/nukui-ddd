<?php

declare(strict_types=1);

namespace App\Core\DataSources;

use Illuminate\Database\Eloquent\Model;

abstract class BaseDs
{
    protected ?Model $_model = null;

    /**
     * @template T
     * @param Model<T> $model
     * @return void
     */
    public function _model(Model $model): void
    {
        $this->_model = $model;
    }

    /**
     * @param array $values
     * @return void
     */
    public function insert(array $values): void
    {
        $this->_model
            ->newQuery()
            ->insert($values);
    }

    /**
     * @param array $values
     * @param array $conditions
     * @return void
     */
    public function update(array $values, array $conditions): void
    {
        $this->_model
            ->newQuery()
            ->where($conditions)
            ->update($values);
    }
}
