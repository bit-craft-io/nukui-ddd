<?php

declare(strict_types=1);

namespace App\Core\DataSources;

use Illuminate\Database\Eloquent\Model;

/**
 * @method void insert(array $values);
 * @method void update(array $values);
 */
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
