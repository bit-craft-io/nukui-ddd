<?php

declare(strict_types=1);

namespace App\Libraries\Traits;

use App\Domains\BaseEnt;
use App\Libraries\Utils\UtilInstance;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

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
}
