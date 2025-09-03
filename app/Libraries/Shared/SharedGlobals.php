<?php

declare(strict_types=1);

namespace App\Libraries\Shared;

class SharedGlobals
{
    private array $_globals = [];
    public function set(string $key, $value): void
    {
        $this->_globals[$key] = $value;
    }

    public function find(string $key): mixed
    {
        if (isset($this->_globals[$key])) {
            return $this->_globals[$key];
        }
        return null;
    }
}
