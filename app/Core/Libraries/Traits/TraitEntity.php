<?php

declare(strict_types=1);

namespace App\Core\Libraries\Traits;

use App\Core\Domains\Entity\BaseEnt;
use App\Core\Libraries\Utils\UtilInstance;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

trait TraitEntity
{
    protected function _entity_class(): string
    {
        $called_class_name = last(explode('\\', static::class));
        $class_prefix = Str::studly(last(explode('_', Str::snake($called_class_name))));
        return "App\Domains\\{$class_prefix}\\Ent{$class_prefix}";
    }

    /**
     * @param Model|null $model
     * @return BaseEnt
     */
    protected function _ent(?Model $model = null): BaseEnt
    {
        /** @var BaseEnt $ent */
        $ent = UtilInstance::prototype($this->_entity_class());
        if ($model && method_exists($ent, 'init')) {
            $ent->init($model);
        }
        return $ent;
    }
}
