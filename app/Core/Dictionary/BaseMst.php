<?php

declare(strict_types=1);

namespace App\Core\Dictionary;

use App\Core\Libraries\Stateful\Instance\StfInsIterator;
use App\Core\Libraries\Stateful\Static\StfStaFactory;
use App\Core\Libraries\Traits\TraitInfrastructure;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class BaseMst
{
    use TraitInfrastructure;

    abstract protected function _get(): Collection;
    abstract public function getIterator(string $key_name = 'id'): StfInsIterator;
    abstract public function toArray(): array;
    abstract public function find(int $id): self;

    protected ?Model $_model = null;

    public function init(?Model $model): self
    {
        $this->_model = $model;
        return $this;
    }

    public function __get(string $name)
    {
        return $this?->_model?->{$name};
    }

    public function iterator(Collection $collect, string $key_name = 'id'): StfInsIterator
    {
        $callable = function ($model) {
            if ($model && method_exists($this, 'init')) {
                $this->init($model);
            }
            return $this;
        };
        $class = StfStaFactory::prototype(StfInsIterator::class);
        $class->init($callable, $collect, $key_name);
        return $class;
    }
}
