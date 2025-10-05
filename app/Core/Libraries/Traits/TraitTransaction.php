<?php

declare(strict_types=1);

namespace App\Core\Libraries\Traits;

use Illuminate\Support\Facades\DB;

trait TraitTransaction
{
    protected function _useTransaction(): void
    {
        DB::beginTransaction();
    }

    protected function _commit(): void
    {
        DB::commit();
    }

    protected function _rollback(): void
    {
        DB::rollBack();
    }
}
