<?php

namespace App\Core\Libraries\Utils;

use Illuminate\Support\Facades\Log;

class UtilDev
{
    public static function emergency(string $message = '', int $mode = 0): void
    {
        $trace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 2);
        $caller = $trace[1] ?? [];
        $class = $caller['class'] ?? 'global scope';
        $line  = $caller['line'] ?? 'none';
        if ($mode)
        Log::emergency("---------- $message::$line::$class");

        Log::emergency("---------- $message::$line");
    }
}
