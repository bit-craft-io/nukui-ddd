<?php

declare(strict_types=1);

namespace App\_Demo\Http\Applications;

use App\_Demo\Http\Requests\Demo\ReqDemoCase01;
use App\Core\Http\Applications\BaseApp;
use App\Core\Http\Requests\ReqNone;

class AppDemo extends BaseApp
{
    public function case01(ReqDemoCase01 $req): void
    {
        // @note BaseReq で user_id を設定してます
        $user_id = $req->user_id;
        // @note $user_id より Create, Update, Delete の処理
        //       ここでは処理は割愛
        echo $user_id;
    }

    /**
     * @note レスポンスにパラメータをセット
     *
     * @param ReqNone $req
     * @return void
     */
    public function case02(ReqNone $req): void
    {
        // @note レスポンスのクラスに追加の値を渡す
        $this->_ResponseParam::set('value', 1);
        $this->_ResponseParam::set('values', ['haga', 'higa', 'fuga']);
        $this->_ResponseParam::set('objects', ['haga' => 1, 'higa' => 2, 'fuga' => 3]);
        $this->_ResponseParam::set('others', [
            'user_id' => $req->user_id,
            'message1' => '非ログインの為、null',
            'message2' => 'user_id は処理内でのみ使用',
            'message3' => 'public_id は他ユーザに知られても良い',
        ]);
    }
}
