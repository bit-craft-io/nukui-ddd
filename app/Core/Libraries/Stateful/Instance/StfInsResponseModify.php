<?php

declare(strict_types=1);

namespace App\Core\Libraries\Stateful\Instance;

final class StfInsResponseModify
{
    protected ?string $_modify = null;

    public function set(string $value = null): void
    {
        $this->_modify = $value;
    }

    public function find(): ?string
    {
        return $this->_modify;
    }
}
