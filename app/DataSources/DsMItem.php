<?php

declare(strict_types=1);

namespace App\DataSources;

use App\Core\DataSources\BaseDs;
use App\Models\MItem;
use Illuminate\Database\Eloquent\Collection;

class DsMItem extends BaseDs
{
    /**
     * @return Collection<MItem>
     */
    public function getEnable(): Collection
    {
        // @note 責任を分離する為
        //       model に builder を記述したく無かった為
        //       where($this->enable の処理にする
        return $this->_model
            ->newQuery()
            ->where($this->enable('begin_at', 'end_at'))
            ->get();
    }
}
