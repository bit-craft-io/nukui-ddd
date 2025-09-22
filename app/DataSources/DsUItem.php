<?php

declare(strict_types=1);

namespace App\DataSources;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class DsUItem extends BaseDs
{
    public function findByUserId(int $user_id): ?Model
    {
        return $this->_model
            ->newQuery()
            ->where('user_id', $user_id)
            ->first();
    }

    public function getByUserId(int $user_id): Collection
    {
        return $this->_model
            ->newQuery()
            ->where('user_id', $user_id)
            ->get();
    }
}
