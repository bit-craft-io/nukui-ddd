<?php

namespace App\Core\Libraries\Stateful\Static;

use Illuminate\Support\Facades\DB;

final class StfStaTransaction
{
    private static bool $is_rollback = false;

    public static function begin(): void
    {
        DB::beginTransaction();
    }

    public static function commit(): void
    {
        DB::commit();
    }

    public static function rollback(): void
    {
        DB::rollBack();
    }

    public static function getLevel(): int
    {
        return DB::transactionLevel();
    }

    public static function isRollback(): bool
    {
        return self::$is_rollback;
    }

    public static function enableRollback(): void
    {
        self::$is_rollback = true;
    }
}
