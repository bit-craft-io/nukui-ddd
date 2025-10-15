<?php

declare(strict_types=1);

namespace App\Core\Http\Middlewares;

use Closure;
use Illuminate\Support\Facades\DB;

final class MdlTransaction
{
    public static bool $is_exception = false;

    public function handle($request, Closure $next)
    {
        // TODO try - catch するか判断

        $response = $next($request);

        \App\Core\Libraries\Stateful\Static\StfStaDev::emergency();

        if (DB::transactionLevel() >= 1) {
            // @note エラーの場合は is_exception が存在
            //$is_exception = UtilGlobals::find('is_exception') ?? false;
            if (self::$is_exception) {
                \App\Core\Libraries\Stateful\Static\StfStaDev::emergency('rollback::');
                DB::rollback();
            } else {
                \App\Core\Libraries\Stateful\Static\StfStaDev::emergency('commit::');
                DB::commit();
            }
        }
        return $response;
    }
}
