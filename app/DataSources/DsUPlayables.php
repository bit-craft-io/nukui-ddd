<?php

declare(strict_types=1);

namespace App\DataSources;

use App\Libraries\Exceptions\ExException;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * DsUPlayables
 */
class DsUPlayables extends BaseDs
{
//    protected ?Model $_model = null;
//
//    /**
//     * @template T
//     * @param Model<T> $model
//     * @return void
//     */
//    public function _model(Model $model): void
//    {
//        $this->_model = $model;
//    }

    /**
     * @param int $id
     * @return Model|null
     * @throws ExException
     */
    public function findOrFailedById(int $id): ?Model
    {
        $model = $this->_model->find($id);
        if (empty($model)) {
            throw new ExException();
        }
        return $model;
    }

    /**
     * @return Collection
     */
    public function devGet(): Collection
    {
        return $this->_model->get();
    }

    /**
     * @param array $values
     * @return void
     */
    public function upsert(array $values): void
    {
        $uniqueBy = ['id'];
        $this->_model->newQuery()->upsert($values, $uniqueBy);
    }
}
