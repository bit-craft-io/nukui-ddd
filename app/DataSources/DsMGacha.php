<?php

declare(strict_types=1);

namespace App\DataSources;

use App\Core\DataSources\BaseDs;
use App\Models\MGacha;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

// TODO getEnable と findEnable は BaseMstVo に吸収してる
class DsMGacha extends BaseDs
{
    /**
     * @return Collection<MGacha>
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

    /**
     * @param int $id
     * @return Model|null
     */
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
