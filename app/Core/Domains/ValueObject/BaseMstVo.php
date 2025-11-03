<?php

declare(strict_types=1);

namespace App\Core\Domains\ValueObject;

use App\Core\Libraries\Stateful\Instance\StfInsIterator;
use App\Core\Libraries\Traits\TraitInfrastructure;
use App\DataSources\DsHub;

abstract class BaseMstVo extends BaseVo
{
    use TraitInfrastructure;

    public function find(int $id): self
    {
        // TODO プロセスキャッシュ化
        //if (process_cache[$key]) {
        //  return process_cache[$key]
        //}
        $short_name = preg_replace('/^VoM/', '', class_basename(static::class));
        $const_name = 'DS_M_' . strtoupper($short_name);
        $model = $this->_Infra::ds(DsHub::{$const_name})->findEnable($id);
        return $this->init($model);
    }

    /**
     * @return StfInsIterator<self>
     */
    public function get(): StfInsIterator
    {
        // TODO プロセスキャッシュ化
        //if (process_cache[$key]) {
        //  return process_cache[$key]
        //}
        $short_name = preg_replace('/^VoM/', '', class_basename(static::class));
        $const_name = 'DS_M_' . strtoupper($short_name);
        $models = $this->_Infra::ds(DsHub::{$const_name})->getEnable();
        return $this->iterator($models);
    }
}
