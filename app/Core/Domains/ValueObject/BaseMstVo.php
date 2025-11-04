<?php

declare(strict_types=1);

namespace App\Core\Domains\ValueObject;

use App\Core\Libraries\Stateful\Instance\StfInsIterator;
use App\Core\Libraries\Traits\TraitApplication;
use App\Core\Libraries\Traits\TraitInfrastructure;
use App\DataSources\DsHub;

abstract class BaseMstVo extends BaseVo
{
    use TraitInfrastructure;
    use TraitApplication;

    public function find(int $id): self
    {
        $short_name = preg_replace('/^VoM/', '', class_basename(static::class));
        $const_name = 'DS_M_' . strtoupper($short_name);
        $cache_key  = "{$const_name}_{$id}";

        return $this->_Cache::array()->remember($cache_key, 600, function () use ($const_name, $id) {
            $model = $this->_Infra::ds(DsHub::{$const_name})->findEnable($id);
            return $this->init($model);
        });
    }

    /**
     * @template T of static
     * @return array<static>|StfInsIterator<static>
     */
    public function get()
    {
        $short_name = preg_replace('/^VoM/', '', class_basename(static::class));
        $const_name = 'DS_M_' . strtoupper($short_name);

        return $this->_Cache::array()->remember($const_name, 600, function () use ($const_name) {
            $models = $this->_Infra::ds(DsHub::{$const_name})->getEnable();
            return $this->iterator($models);
        });
    }
}
