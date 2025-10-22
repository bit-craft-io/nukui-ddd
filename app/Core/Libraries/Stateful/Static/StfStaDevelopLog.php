<?php

namespace App\Core\Libraries\Stateful\Static;

use Illuminate\Support\Facades\Log;

final class StfStaDevelopLog
{
    /**
     * @param string|int $message
     * @param Enums\TypeLogText $type_log_text
     * @return void
     */
    public static function emergency(string|int $message = '--', Enums\TypeLogText $type_log_text = Enums\TypeLogText::Api): void
    {
        $trace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 2);
        $caller = $trace[1] ?? [];
        $class_fqcn = $caller['class'] ?? 'global scope';
        $line = $caller['line'] ?? 'none';

        Log::emergency("----------------------------------------");
        if ($type_log_text->isApi()) {
            $parts = explode('\\', $class_fqcn);
            $app = end($parts);
            $func = $caller['function'];
            Log::emergency("$app::$func($line)::$message");
            return;
        }

        $class_path = preg_replace('/^App\\\\/', '', $class_fqcn);
        Log::emergency("$class_path($line)::$message");
    }
}
