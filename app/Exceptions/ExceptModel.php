<?php

declare(strict_types=1);

namespace App\Exceptions;

use App\Http\Applications\Api\AppAccount;
use Exception;

final class ExceptModel extends Exception
{
    /**
     * @template T of array{code:int, message:string, temp:string}
     *
     * @param T $error_info
     * @return self
     */
    public function exception(array $error_info): ExceptModel
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

        $this->code = $error_info['code'];
        $this->message = $error_info['message'];
        return $this;
    }
}
