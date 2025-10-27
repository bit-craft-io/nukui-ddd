<?php

declare(strict_types=1);

namespace App\Http\Applications;

use App\Core\Exceptions\Enums\TypeExcept;
use App\Core\Http\Applications\BaseApp;
use App\Core\Http\Requests\ReqNone;
use App\Domains\RepHub;

class AppItem extends BaseApp
{
    public function get(ReqNone $req): void
    {
//        ///** @var class-string<TypeExcept> $enum */
//        $enum = $this->_Except::appUserNotFound();

        //throw $this->_Except::app(TypeExcept::AppUserNotFound);

        // @note getのみなので Response クラスもしくは
        //       Appクラスで処理をして param に渡す？
        //       param に渡す方がResクラスが共通で使えてエレガントっぽい
        $repItem = $this->_Domain::rep(RepHub::REP_ITEM);
        $entItems = $repItem->getByUserId($req->user_id);

        // TODO item_id = 1
        $entItem = $entItems->find(1);
        $this->_ResponseParam::set('item', $entItem->getProperties());
    }

    public function dummy(array $params): void
    {
        dd(__LINE__);
    }
}
