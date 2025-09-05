<?php

declare(strict_types=1);

namespace App\DataSources;

use Illuminate\Database\Eloquent\Collection;

/**
 * DsUGuild
 */
class DsUGuilds extends BaseDs
{
    /**
     * @return Collection
     */
    public function devGet(): Collection
    {
        return $this->_model->get();
    }
}
