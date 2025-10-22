<?php

namespace App\Core\Libraries\Stateful\Static\Enums;

enum TypeLogText: int
{
    case Api = 1;
    case Cls = 2;

    public function isApi(): bool
    {
        return $this == self::Api;
    }

    public function isClass(): bool
    {
        return $this == self::Cls;
    }
}
