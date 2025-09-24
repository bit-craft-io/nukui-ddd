<?php

declare(strict_types=1);

namespace App\Domains\Core\ValueObject;

use App\Libraries\Utils\UtilIterator;

class BaseVo
{
    protected ?array $_props = null;

    public function _props(array $props)
    {
        $this->_props = $props;
    }

    public function __get(string $name)
    {
        return $this?->_props[$name] ?? null;
    }

    public function iterator($collect): UtilIterator
    {
        $callable = function ($props) {
            if ($props && method_exists($this, '_props')) {
                $this->_props($props->toArray());
            }
            return $this;
        };
        $iterator = app(UtilIterator::class);
        $iterator->init($callable, $collect);
        return $iterator;
    }
}
