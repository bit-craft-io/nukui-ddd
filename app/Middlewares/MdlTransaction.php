<?php

declare(strict_types=1);

namespace App\Middlewares;

use App\Libraries\Utils\UtilGlobals;
use Closure;
use Illuminate\Support\Facades\DB;

final class MdlTransaction
{
    public function handle($request, Closure $next)
    {
        // TODO try - catch するか判断

        $response = $next($request);

        \Log::emergency('---------- ::' . __CLASS__ . '::' . __LINE__);

        if (DB::transactionLevel() >= 1) {
            // @note エラーの場合は is_exception が存在
            $is_exception = UtilGlobals::find('is_exception') ?? false;
            if ($is_exception) {
                \Log::emergency('---------- rollback::' . __LINE__);
                DB::rollback();
            } else {
                \Log::emergency('---------- commit::' . __LINE__);
                DB::commit();
            }
        }
        return $response;
    }
}
