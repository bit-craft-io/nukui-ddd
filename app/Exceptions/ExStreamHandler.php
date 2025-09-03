<?php

declare(strict_types=1);

namespace App\Exceptions;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Monolog\LogRecord;

/**
 * @note $next($request) で Exception がある時に
 *  強制的にエラーログが出力されてしまう為
 *  config/logging.php の
 *  'handler' => StreamHandler::class をオーバーライドして制御
 */
class ExStreamHandler extends StreamHandler
{
    // 必要ならコンストラクタや処理をオーバーライド
    public function __construct($stream = 'php://stderr', $level = Logger::DEBUG, bool $bubble = true)
    {
        parent::__construct($stream, $level, $bubble);
    }

    public function handle(LogRecord $record): bool
    {
        // ここでログのフィルターや加工を実装できる
        // 例外レコードだったら無視とかもできる
        if (isset($record['context']['exception'])) {
            // 例外時はログ抑制したいならfalse返すとか
            return false;
        }
        return parent::handle($record);
    }
}
