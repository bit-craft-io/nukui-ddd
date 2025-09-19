<?php

declare(strict_types=1);

namespace App\Domains\VOs;

class BaseVo
{
    protected ?array $_props = null;

    public function __get(string $name)
    {
        return $this?->_props[$name] ?? null;
    }
}
