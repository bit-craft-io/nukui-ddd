<?php

declare(strict_types=1);

namespace App\DataSources;

use App\Core\DataSources\BaseDs;
use App\Models\MGachaDrawEntity;
use App\Models\MGachaDrawRarity;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class DsMGachaDrawRarity extends BaseDs
{
    /**
     * @return Collection<MGachaDrawRarity>
     */
    public function getEnable(array $conditions = []): Collection
    {
        return $this->_model
            ->newQuery()
            ->where($conditions)
            ->where('is_active', 1)
            ->where($this->enable('begin_at', 'end_at'))
            ->get();
    }

    public function findEnable(int $id): ?Model
    {
        return $this->_model
            ->newQuery()
            ->where('id', $id)
            ->where('is_active', 1)
            ->where($this->enable('begin_at', 'end_at'))
            ->first();
    }
}
