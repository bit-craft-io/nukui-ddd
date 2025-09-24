<?php

declare(strict_types=1);

namespace App\Exceptions;

use Exception;

class ExceptApp extends Exception
{
    /**
     * @param TypeExcept $type_except
     * @return self
     */
    public function make(TypeExcept $type_except): self
    {
        $this->code = $type_except->value;
        $this->message = $type_except->message();
        return $this;
    }
}
