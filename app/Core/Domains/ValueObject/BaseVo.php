<?php

declare(strict_types=1);

namespace App\Core\Domains\ValueObject;

use App\Core\Libraries\Stateful\Instance\StfInsIterator;
use App\Core\Libraries\Stateful\Static\StfStaFactory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class BaseVo
{
    protected Model|array|null $_props = null;

    public function init(Model|array $props): self
    {
        $this->_props = $props;
        return $this;
    }

    public function __get(string $name)
    {
        return $this?->_props[$name] ?? null;
    }

    // @note ValueObject は mutable の為、setter は存在しない
    //public function __call(string $name, array $arguments = [])

    public function iterator(Collection $collect, string $key_name = 'id'): StfInsIterator
    {
        $callable = function ($model) {
            if ($model && method_exists($this, 'init')) {
                // @note Collection<Model>
                $this->init($model);
            }
            return $this;
        };
        $class = StfStaFactory::prototype(StfInsIterator::class);
        $class->init($callable, $collect, $key_name);
        return $class;
    }
}
