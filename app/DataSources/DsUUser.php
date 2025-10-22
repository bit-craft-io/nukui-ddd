<?php

declare(strict_types=1);

namespace App\DataSources;

use App\Core\DataSources\BaseDs;
use Illuminate\Database\Eloquent\Model;

class DsUUser extends BaseDs
{
    /**
     * @param int $user_id
     * @return Model|null
     */
    public function findByUserId(int $user_id): ?Model
    {
        return $this->_model
            ->newQuery()
            ->where('id', $user_id)
            ->first();
    }

    /**
     * @param string $public_id
     * @return Model|null
     */
    public function findByPublicId(string $public_id): ?Model
    {
        return $this->_model
            ->newQuery()
            ->where('public_id', $public_id)
            ->first();
    }

    /**
     * @param array $values
     * @return void
     */
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

    public function dummy(): ?Model
    {
        //throw $this->_modelException();
    }
}
