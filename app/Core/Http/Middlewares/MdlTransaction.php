<?php

declare(strict_types=1);

namespace App\Core\Http\Middlewares;

use App\Core\Libraries\Traits\TraitDevelop;
use App\Core\Libraries\Traits\TraitTransaction;
use Closure;

final class MdlTransaction
{
    use TraitDevelop;
    use TraitTransaction;

    /**
     * @param $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // TODO try - catch するか判断
        $response = $next($request);

        $this->_DevLog::emergency('begin');

        $tranLevel = $this->_Transaction::getLevel();

        // @note ロールバック
        if ($this->_Transaction::isRollback()) {
            for ($i = 0; $i < $tranLevel; $i++) {
                $this->_DevLog::emergency('rollback');
                $this->_Transaction::rollback();
            }
            $this->_DevLog::emergency('end');
            return $response;
        }

        // @note コミット
        for ($i = 0; $i < $tranLevel; $i++) {
            $this->_DevLog::emergency('commit');
            $this->_Transaction::commit();
        }
        $this->_DevLog::emergency('end');
        return $response;
    }
}
