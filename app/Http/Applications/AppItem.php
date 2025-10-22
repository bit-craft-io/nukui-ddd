<?php

declare(strict_types=1);

namespace App\Http\Applications;

use App\Core\Exceptions\Enums\TypeExcept;
use App\Core\Http\Applications\BaseApp;
use App\Core\Http\Requests\ReqNone;
use App\Domains\Rep;

class AppItem extends BaseApp
{
    public function get(ReqNone $req): void
    {
        //throw $this->_except(Except::EXCEPT_APP)->make(TypeExcept::AppUserNotFound);
        throw $this->_except::app(TypeExcept::AppUserNotFound);

        // @note getのみなので Response クラスもしくは
        //       Appクラスで処理をして param に渡す？
        //       param に渡す方がResクラスが共通で使えてエレガントっぽい
        $repItem = $this->_domain::rep(Rep::REP_ITEM);
        $entItems = $repItem->getByUserId($req->user_id);
        // TODO item_id = 1
        $entItem = $entItems->find(1);
        $this->_response()->param::set('item', $entItem->getProperties());
    }

    public function dummy(array $params): void
    {
        dd(__LINE__);
    }
}
