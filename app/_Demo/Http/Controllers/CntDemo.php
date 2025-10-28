<?php

declare(strict_types=1);

namespace App\_Demo\Http\Controllers;

use App\_Demo\Http\Applications\AppDemo;
use App\_Demo\Http\Requests\Demo\ReqDemoCase01;
use App\_Demo\Http\Responses\Demo\ResDemoCase01;
use App\Core\Http\Controllers\BaseCnt;
use App\Core\Http\Requests\ReqNone;
use App\Core\Http\Responses\ResSuccess;
use App\Core\Libraries\Traits\TraitDevelop;
use Exception;

class CntDemo extends BaseCnt
{
    use TraitDevelop;

    /**
     * @note コンストラクタインジェクション
     * @note レスポンスのクラスを自動生成
     *
     * @param AppDemo $app
     * @param ReqDemoCase01 $req
     * @return void
     */
    public function case01(AppDemo $app, ReqDemoCase01 $req): void
    {
        // @note レスポンスのクラスは MdlResponse で自動生成
        //       API が demo/case01 の場合は ResDemoCase01
        $app->case01($req);
    }

    /**
     * @note レスポンスのクラスを変更
     *
     * @param AppDemo $app
     * @param ReqNone $req
     * @return void
     */
    public function case02(AppDemo $app, ReqNone $req): void
    {
        // @note レスポンスのクラスを変更
        $this->_ResponseModify::set(ResSuccess::class);
        $app->case02($req);
    }

    /**
     * @note Appクラス無し
     *
     * @param AppDemo $app
     * @param ReqNone $req
     * @return void
     */
    public function case03(AppDemo $app, ReqNone $req): void
    {
        // @note レスポンスのクラスは MdlResponse で自動生成
    }

    //        //$val = $this->_DevTool::getValueSize('hoge-fuga');
    //        //$this->_DevLog::emergency((string)$val);

    /**
     * @throws Exception
     */
    public function app01(AppDemo $app, ReqNone $req): void
    {
        $this->_ResponseModify::set(ResSuccess::class);
        $app->app01($req);
    }
}
