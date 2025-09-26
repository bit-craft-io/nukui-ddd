<?php

declare(strict_types=1);

namespace App\DataSources\Core;

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
}
