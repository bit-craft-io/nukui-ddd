<?php

declare(strict_types=1);

namespace App\Core\Exceptions;

use App\Core\Exceptions\Enum\TypeExcept;
use Exception;

final class ExceptModel extends Exception
{
    /**
     * @param TypeExcept $type_except
     * @param array $except_params
     * @return $this
     */
    public function init(TypeExcept $type_except, array $except_params = []): ExceptModel
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
        $this->message = $type_except->message($except_params);
        return $this;
    }
}
