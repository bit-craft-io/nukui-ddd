<?php

declare(strict_types=1);

namespace App\Middlewares;

use Closure;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MdlTransaction
{
    public function handle($request, Closure $next)
    {
        // TODO try - catch するか判断

        $response = $next($request);
Log::emergency(__CLASS__ . '::' . __LINE__);
        if (DB::transactionLevel() >= 1) {
            // TODO _isException
            if (app()->_isException ?? false) {
                DB::rollback();
            } else {
                DB::commit();
            }
        }
        return $response;
    }
}
