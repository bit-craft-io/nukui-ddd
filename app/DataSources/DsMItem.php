<?php

declare(strict_types=1);

namespace App\DataSources;

use App\Core\DataSources\BaseDs;
use App\Models\MGacha;
use App\Models\MItem;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class DsMItem extends BaseDs
{
    /**
     * @return Collection<MItem>
     */
    public function getEnable(array $conditions = []): Collection
    {
        // @note 責任を分離する為
        //       model に builder を記述したく無かった為
        //       where($this->enable の処理にする
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
