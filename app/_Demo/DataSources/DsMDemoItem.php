<?php

declare(strict_types=1);

namespace App\_Demo\DataSources;

use App\_Demo\Models\MDemoItem;
use App\Core\DataSources\BaseDs;
use Illuminate\Database\Eloquent\Collection;

class DsMDemoItem extends BaseDs
{
    /**
     * @return Collection<MDemoItem>
     */
    public function getEnable(): Collection
    {
        return $this->_model
            ->newQuery()
            ->where($this->enable('begin_at', 'end_at'))
            ->get();
    }
}
