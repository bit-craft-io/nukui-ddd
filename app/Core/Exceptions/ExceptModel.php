<?php

declare(strict_types=1);

namespace App\Core\Exceptions;

use App\Core\Exceptions\Enums\TypeExcept;
use Exception;

final class ExceptModel extends Exception
{
    /**
     * @param TypeExcept $type_except
     * @return self
     */
    public function init(TypeExcept $type_except): ExceptModel
    {
        // TODO ログ出力
        $trace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 2);
        $caller = $trace[1] ?? [];
        $log = [
            'file' => $caller['file'] ?? 'unknown',
            'line' => $caller['line'] ?? 0,
            'class' => $caller['class'] ?? 'global',
            'function' => $caller['function'] ?? 'global',
            'type' => $caller['type'] ?? '',
        ];

        $this->code = $type_except->value;
        $this->message = $type_except->message();
        return $this;
    }
}
