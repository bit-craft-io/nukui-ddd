<?php

namespace App\Core\Jobs\Contexts;

/**
 * @property-read integer $_user_id
 * @property-read integer $_level
 * @property-read string $_api
 * @property-read array $_param
 * @property-read string $_file
 * @property-read integer $_line
 * @property-read array $_option
 */
class AccessInfo
{
    public function __construct(
        public int $_user_id = 0,
        public int $_level = 0,
        public string $_api = '',
        public array $_param = [],
        public string $_file = '',
        public int $_line = 0,
        public array $_option = [],
    ) {}

    public static function make(int $user_id, array $option): self
    {
//        // @note 呼び出し元を取得
//        $source = [];
//        $backtrace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 2);
//        $caller = $backtrace[0] ?? null;
//        $relative_path = str_replace(base_path() . DIRECTORY_SEPARATOR, '', $caller['file']);
//        if ($caller && isset($caller['file'])) {
//            $source = [
//                'file' => $relative_path,
//                'line' => $caller['line'] ?? 0,
//            ];
//        }
//        return new self($user_id, $source, $info);
        // @note 呼び出し元
        $backtrace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 2);
        $caller = $backtrace[1] ?? [];
        $file = isset($caller['file'])
            ? str_replace(base_path() . DIRECTORY_SEPARATOR, '', $caller['file'])
            : '';
        $line = $caller['line'] ?? 0;

        $api = request()->path() ?? '';
        $param = request()->all();

        return new self(
            _user_id: $user_id,
            _api: $api,
            _param: $param,
            _file: $file,
            _line: $line,
            _option: $option
        );
    }
}
