<?php

declare(strict_types=1);

namespace App\Core\Http\Middlewares;

use App\Core\Libraries\Traits\TraitDevelop;
use App\Core\Libraries\Traits\TraitTransaction;
use Closure;
use Illuminate\Support\Facades\DB;

final class MdlTransaction
{
    use TraitDevelop;
    use TraitTransaction;

    //public static bool $is_exception = false;

    public function handle($request, Closure $next)
    {
        // TODO try - catch するか判断
        $response = $next($request);

        $this->_DevLog::emergency();

        if ($this->_Transaction::getLevel()) {
            // @note エラーの場合は is_exception が存在
            if ($this->_Transaction::isRollback()) {
                $this->_DevLog::emergency('rollback');
                $this->_Transaction::rollback();
            } else {
                $this->_DevLog::emergency('commit');
                $this->_Transaction::commit();
            }
        }
        return $response;
    }
}
