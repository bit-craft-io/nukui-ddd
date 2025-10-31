<?php

declare(strict_types=1);

namespace App\DataSources;

use App\Core\DataSources\BaseDs;
use App\Models\MGacha;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class DsMGacha extends BaseDs
{
    /**
     * @return Collection<MGacha>
     */
    public function getEnable(): Collection
    {
        return $this->_model
            ->newQuery()
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
