<?php

declare(strict_types=1);

namespace App\Middlewares;

use App\Libraries\Traits\Useful;
use Closure;
use Illuminate\Support\Facades\DB;

/**
 * MdlTransaction
 */
class MdlTransaction
{
    //use Useful;
    public function handle($request, Closure $next)
    {
        $response = $next($request);
        if (DB::transactionLevel() >= 1) {
            if (app()->_isException ?? false) {
                DB::rollback();
            } else {
                DB::commit();
            }
        }
        return $response;
    }
}
