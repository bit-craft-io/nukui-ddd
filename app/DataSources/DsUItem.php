<?php

declare(strict_types=1);

namespace App\DataSources;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class DsUItem extends BaseDs
{
    public function getDraft(): ?Model
    {
        return $this->_model;
    }

    public function getByUserId(int $user_id): Collection
    {
        return $this->_model
            ->newQuery()
            ->where('user_id', $user_id)
            ->get();
    }

    public function upsert(array $values): void
    {
        $uniqueBy = ['user_id', 'item_id'];
        $this->_model
            ->newQuery()
            ->upsert($values, $uniqueBy);
    }
}
