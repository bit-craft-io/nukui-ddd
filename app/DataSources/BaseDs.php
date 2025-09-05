<?php

namespace App\DataSources;

use Illuminate\Database\Eloquent\Model;

class BaseDs
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
}
