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
        return $this->_model
            ->newQuery()
            ->enable()
            ->get();
    }
}
