<?php

declare(strict_types=1);

namespace App\Core\Http\Middlewares;

use App\Core\Libraries\Traits\TraitApplication;
use App\Core\Libraries\Traits\TraitTransaction;
use Closure;

final class MdlTransaction
{
    use TraitApplication;
    use TraitTransaction;

    /**
     * @param $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        $this->_Log::info('begin');

        $tranLevel = $this->_Transaction::getLevel();

        // @note ロールバック
        if ($this->_Transaction::isRollback()) {
            for ($i = 0; $i < $tranLevel; $i++) {
                $this->_Log::info('rollback');
                $this->_Transaction::rollback();
            }
            $this->_Log::info('end');
            return $response;
        }

        // @note コミット
        for ($i = 0; $i < $tranLevel; $i++) {
            $this->_Log::info('commit');
            $this->_Transaction::commit();
        }
        $this->_Log::info('end');
        return $response;
    }
}
