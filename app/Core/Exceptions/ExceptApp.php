<?php

declare(strict_types=1);

namespace App\Core\Exceptions;

use App\Core\Exceptions\Enums\TypeExcept;
use Exception;

final class ExceptApp extends Exception
{
    /**
     * @param TypeExcept $type_except
     * @param array $except_params
     * @return $this
     */
    public function init(TypeExcept $type_except, array $except_params = []): self
    {
        $this->code = $type_except->value;
        $this->message = $type_except->message($except_params);
        return $this;
    }
}
