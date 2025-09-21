<?php

declare(strict_types=1);

namespace App\DataSources;

use Illuminate\Database\Eloquent\Model;

class DsUUser extends BaseDs
{
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
}
