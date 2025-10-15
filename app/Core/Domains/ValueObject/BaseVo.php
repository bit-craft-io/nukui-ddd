<?php

declare(strict_types=1);

namespace App\Core\Domains\ValueObject;

use App\Core\Libraries\Stateful\Static\StfStaIterator;

abstract class BaseVo
{
    protected ?array $_props = null;

    public function init(array $props): self
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
    //{
    //    $this->_props[$name] = $arguments[0];
    //}

    public function iterator($collect): StfStaIterator
    {
        $callable = function ($props) {
            if ($props && method_exists($this, 'init')) {
                $this->init($props->toArray());
            }
            return $this;
        };
        $iterator = app(StfStaIterator::class);
        $iterator->init($callable, $collect);
        return $iterator;
    }
}
