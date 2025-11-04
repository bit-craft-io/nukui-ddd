<?php

declare(strict_types=1);

namespace App\Core\Domains\ValueObject;

use App\Core\Libraries\Stateful\Instance\StfInsIterator;
use App\Core\Libraries\Traits\TraitApplication;
use App\Core\Libraries\Traits\TraitInfrastructure;
use App\DataSources\DsHub;
use Illuminate\Database\Eloquent\Model;

abstract class BaseMstVo extends BaseVo
{
    use TraitInfrastructure;
    use TraitApplication;

    private int $_ttl_sec = 600;

    private function _dsConstName(): string
    {
        // @note VoM[Model] から DS_M_[Model] を作成
        $model_name = preg_replace('/^VoM/', '', class_basename(static::class));
        return 'DS_M_' . strtoupper($model_name);
    }

    public function find(int $id): self
    {
        $const_name = $this->_dsConstName();

        $callback = function () use ($const_name, $id) {
            $model = $this->_Infra::ds(DsHub::{$const_name})->findEnable($id);
            return $this->init($model);
        };

        return $this->_Cache::array()->remember("{$const_name}_{$id}", $this->_ttl_sec, $callback);
    }

    /**
     * @return array<static>|StfInsIterator<static>
     */
    public function get(): array|StfInsIterator
    {
        $const_name = $this->_dsConstName();

        $callback = function () use ($const_name) {
            $models = $this->_Infra::ds(DsHub::{$const_name})->getEnable();
            return $this->iterator($models);
        };

        return $this->_Cache::array()->remember($const_name, $this->_ttl_sec, $callback);
    }
}
