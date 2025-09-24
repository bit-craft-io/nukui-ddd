<?php

declare(strict_types=1);

namespace App\DataSources;

use Illuminate\Database\Eloquent\Model;

class DsUUser extends BaseDs
{
    public function findByUserId(int $user_id): ?Model
    {
        return $this->_model
            ->newQuery()
            ->where('id', $user_id)
            ->first();
    }

    public function findByPublicId(string $public_id): ?Model
    {
        return $this->_model
            ->newQuery()
            ->where('public_id', $public_id)
            ->first();
    }

    public function upsert(array $values): void
    {
        $uniqueBy = ['id'];
        $this->_model
            ->newQuery()
            ->upsert($values, $uniqueBy);
    }

    /**
     * @return Model|null
     */
    public function getDraft(): ?Model
    {
        return $this->_model;
    }

    public function insert(array $values): void
    {
        $this->_model
            ->newQuery()
            ->insert($values);
    }

    public function dummy(): ?Model
    {
        throw $this->_modelException(self::ERR_MDL_DATA_NOT_FOUND);
    }
}
