<?php

declare(strict_types=1);

namespace App\Domains\Core\ValueObject;

use App\Libraries\Utils\UtilIterator;

abstract class BaseEntVo
{
    protected ?object $_this_ent = null;
    public function init(object $this_ent): self
    {
        $this->_this_ent = &$this_ent;
        return $this;
    }

    public function __get(string $name)
    {
        return $this?->_this_ent?->$name;
    }

    public function __call(string $name, array $arguments = [])
    {
        $this->_this_ent->$name($arguments[0]);
    }
}
