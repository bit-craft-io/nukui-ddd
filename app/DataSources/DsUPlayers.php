<?php

declare(strict_types=1);

namespace App\DataSources;

use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * DsUPlayables
 */
class DsUPlayers extends BaseDs
{
    /**
     * @param int $id
     * @return Model|null
     * @throws Exception
     */
    public function find(int $id): ?Model
    {
        $model = $this->_model
            ->newQuery()
            ->find($id);

        if (empty($model)) {
            // TODO App の Exception
            throw new Exception();
        }
        return $model;
    }

    /**
     * @return Collection
     */
    public function get(): Collection
    {
        return $this->_model
            ->newQuery()
            ->limit(10)
            ->get();
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
