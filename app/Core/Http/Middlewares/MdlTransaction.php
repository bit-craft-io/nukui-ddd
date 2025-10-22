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

        $this->_dev()->log::emergency();

        if ($this->_transaction::getLevel()) {
            // @note エラーの場合は is_exception が存在
            if ($this->_transaction::isRollback()) {
                $this->_dev()->log::emergency('rollback');
                $this->_transaction::rollback();
            } else {
                $this->_dev()->log::emergency('commit');
                $this->_transaction::commit();
            }
        }
        return $response;
    }
}
