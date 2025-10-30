<?php

declare(strict_types=1);

namespace App\DataSources;

use App\Core\DataSources\BaseDs;
use App\Models\MGacha;
use Illuminate\Database\Eloquent\Collection;

class DsMGacha extends BaseDs
{
    /**
     * @return Collection<MGacha>
     */
    public function getEnable(): Collection
    {
        return $this->_model
            ->newQuery()
            ->where($this->enable('begin_at', 'end_at'))
            ->get();
    }
}
