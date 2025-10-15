<?php

declare(strict_types=1);

namespace App\Core\Libraries\Stateful\Instance;

final class StfInsResponseParam
{
    protected array $_param = [];

    public function set(string $key = '', $value = null): void
    {
        $this->_param[$key] = $value;
    }

    public function get(): array
    {
        return $this->_param;
    }

    public function find(string $key = null)
    {
        return $this->_param[$key] ?? null;
    }
}
