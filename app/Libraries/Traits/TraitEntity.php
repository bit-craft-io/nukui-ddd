<?php

declare(strict_types=1);

namespace App\Libraries\Traits;

use App\Domains\Core\Entity\BaseEnt;
use App\Libraries\Utils\UtilInstance;
use App\Libraries\Utils\UtilIterator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Iterator;

trait TraitEntity
{
    protected function _entFQCN(): string
    {
        $called_class_name = last(explode('\\', static::class));
        $class_prefix = Str::studly(last(explode('_', Str::snake($called_class_name))));
        return "App\Domains\\{$class_prefix}\\Ent{$class_prefix}";
    }

    /**
     * @param Model|null $model
     * @return BaseEnt
     */
    protected function _ent(?Model $model): BaseEnt
    {
        /** @var BaseEnt $ent */
        $ent = UtilInstance::prototype($this->_entFQCN());
        if ($model && method_exists($ent, '_model')) {
            $ent->_model($model);
        }
        return $ent;
    }

    /**
     * @param Collection<Model> $models
     * @return Collection<BaseEnt>
     */
    protected function _ents(string $class, Collection $models): UtilIterator
    {
        // @note 20250924 イテレータ
        $ent = UtilInstance::prototype($class);
        $callable = function ($model) use ($ent) {
            if ($model && method_exists($ent, '_model')) {
                $ent->_model($model);
            }
            return $ent;
        };
        $iterator = UtilInstance::prototype(UtilIterator::class);
        $iterator->init($callable, $models);
        return $iterator;
    }
}
