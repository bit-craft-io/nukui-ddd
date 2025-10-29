<?php

declare(strict_types=1);

namespace App\DataSources;

use App\Core\DataSources\BaseDs;
use App\Models\UGacha;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class DsUGacha extends BaseDs
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

    public function findByUserId(int $user_id): ?UGacha
    {
        return $this->_model
            ->newQuery()
            ->where('user_id', $user_id)
            ->first();
    }
}
