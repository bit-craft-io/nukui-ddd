<?php

declare(strict_types=1);

namespace App\DataSources;

use Illuminate\Database\Eloquent\Model;

class DsMItem extends BaseDs
{
    public function getEnable(): ?Model
    {
        return $this->_model;
    }
}
