<?php

declare(strict_types=1);

namespace App\Http\Applications;

use App\Domains\Rep;
use Exception;
use Illuminate\Support\Facades\Log;

class AppPlayer extends BaseApp
{
    /**
     * @param array $params
     * @return void
     * @throws Exception
     */
    public function find(array $params): void
    {
        $rep = $this->_rep(Rep::PLAYER);
        $ent = $rep->findPlayer((int)$params['id']);
        //$ent->_nick_name('test3');
        //$ent->commit();
        $ent->draftFill(['nick_name' => 'test5']);
Log::emergency($ent->nick_name);
//        $ent->_type_play_style(TypePlayStyle::COLLECTOR);
//        $ent->_nick_name('test');
//        $ent->consumeStamina(10);
//        $ent->recoveryStamina(50);
        $rep->persist($ent);
    }

    ///**
    // * @param array $params
    // * @return void
    // */
    //public function search_type_a(array $params): void
    //{
    //    // @note 配列のデータを処理する時の説明
    //    // @note データソースからリストを取得（devXxx は開発用のメソッド）
    //    //  データソースはリポジトリで使用するが
    //    //  リストを一括で処理する場合はビジネスロジックで使用
    //    //  別案として
    //    //  リポジトリからエンティティのコレクションの取得も考えられるが
    //    //  処理コストが大きく成る為、
    //    //  ビジネスロジックでリストを取得してドメインのクラスを使用して処理をしている（いま時点で最良の案）
    //    $rep = $this->_rep(Rep::PLAYABLE);
    //    $u_playables = $rep->ds()->devGet();
    //    foreach ($u_playables as $u_playable)
    //    {
    //        // @note ドメインの判定処理を使用する場合は worker（使いまわし）を使用
    //        $ent_playable_worker = $rep->worker($u_playable->toArray());
    //        // @note ドメインの判定処理を使用
    //        if ($ent_playable_worker->isSolo()) {
    //            // @note 直接モデルに値を設定
    //            $u_playable->nick_name = 'solo2';
    //            $u_playable->stamina_count = 200;
    //        }
    //    }
    //    // @note 一括で更新処理
    //    $rep->ds()->upsert($u_playables->toArray());
    //}

    /**
     * @param array $params
     * @return void
     */
    public function search_type_b(array $params): void
    {
        // @note 順次処理をする場合は Iterator を使用する
        // @note 順次処理ではない場合 $rep->worker($arguments) を使用する
        $rep = $this->_rep(Rep::PLAYER);
        $ent_players = $rep->getPlayers();
        foreach ($ent_players as $ent_player) {
            Log::emergency($ent_player->nick_name);
            $ent_player->draftFill(['nick_name' => 'test5']);
            $rep->persist($ent_player);
        }
    }
}
