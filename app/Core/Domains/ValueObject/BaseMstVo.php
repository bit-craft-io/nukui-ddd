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

    /**
     * @return string
     */
    private function _dsConstName(): string
    {
        // @note VoM[Model] から DS_M_[Model] を作成
        $model_name = preg_replace('/^VoM/', '', class_basename(static::class));
        return 'DS_M_' . strtoupper($model_name);
    }

    /**
     * @param int $id
     * @return static
     */
    public function find(int $id): self
    {
        $const_name = $this->_dsConstName();

        $callback = function () use ($const_name, $id) {
            $model = $this->_Infra::ds(DsHub::{$const_name})->findEnable($id);
            return $this->init($model);
        };

        $config = $this->_Config::core();
        if (!$config->cache_enable) {
            return $callback();
        }

        $key = "{$const_name}_{$id}";
        return $this->_Cache::array()->remember($key, $config->cache_default_ttl_sec, $callback);
    }

    /**
     * @return array<static>|StfInsIterator<static>
     */
    public function get(array $conditions = []): array|StfInsIterator
    {
        $const_name = $this->_dsConstName();

        $callback = function () use ($const_name, $conditions) {
            $models = $this->_Infra::ds(DsHub::{$const_name})->getEnable($conditions);
            return $this->iterator($models);
        };

        $config = $this->_Config::core();
        if (!$config->cache_enable) {
            return $callback();
        }

        $key = "{$const_name}_" . serialize($conditions);
        return $this->_Cache::array()->remember($key, $config->cache_default_ttl_sec, $callback);
    }
}
