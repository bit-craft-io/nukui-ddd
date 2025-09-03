<?php

declare(strict_types=1);

namespace App\Http\Applications;

use App\Domains\Rep;
use App\Libraries\Exceptions\ExException;
use App\Models\Enums\TypePlayStyle;
use Exception;
use Illuminate\Support\Facades\Log;

class AppPlayable extends BaseApp
{
//    use AppLibException;

    /**
     * @param array $params
     * @return void
     * @throws Exception
     */
    public function find(array $params): void
    {
        //$ent = $this->_rep(Rep::PLAYABLE)->findOrFailedById((int)$params['id']);
        $rep = $this->_rep(Rep::PLAYABLE);
        $ent = $rep->findOrFailedById((int)$params['id']);
        $ent->_type_play_style(TypePlayStyle::COLLECTOR);
        $ent->_nick_name('test');
        $ent->consumeStamina(10);
        $ent->recoveryStamina(50);
        // @note 変更内容を反映
        $ent->commit();
//        if ($ent->isSolo()) {
//            Log::debug('isSolo');
//        }
    }

    /**
     * @param array $params
     * @return void
     */
    public function search_type_a(array $params): void
    {
        // @note 配列のデータを処理する時の説明
        // @note データソースからリストを取得（devXxx は開発用のメソッド）
        //  データソースはリポジトリで使用するが
        //  リストを一括で処理する場合はビジネスロジックで使用
        //  別案として
        //  リポジトリからエンティティのコレクションの取得も考えられるが
        //  処理コストが大きく成る為、
        //  ビジネスロジックでリストを取得してドメインのクラスを使用して処理をしている（いま時点で最良の案）
        $rep = $this->_rep(Rep::PLAYABLE);
        $u_playables = $rep->ds()->devGet();
        foreach ($u_playables as $u_playable)
        {
            // @note ドメインの判定処理を使用する場合は worker（使いまわし）を使用
            $ent_playable_worker = $rep->worker($u_playable->toArray());
            // @note ドメインの判定処理を使用
            if ($ent_playable_worker->isSolo()) {
                // @note 直接モデルに値を設定
                $u_playable->nick_name = 'solo2';
                $u_playable->stamina_count = 200;
            }
        }
        // @note 一括で更新処理
        $rep->ds()->upsert($u_playables->toArray());
    }

    /**
     * @param array $params
     * @return void
     */
    public function search_type_b(array $params): void
    {
        // @note 順次処理をする場合は Iterator を使用する
        // @note 順次処理ではない場合 $rep->worker($arguments) を使用する
        $rep = $this->_rep(Rep::PLAYABLE);
        $ent_playables = $rep->getPlayables();
        foreach ($ent_playables as $ent_playable) {
            if ($ent_playable->isSolo()) {
                $ent_playable->_nick_name('solo4');
                $ent_playable->_stamina_count(200);
            }
            $rep->persist($ent_playable);
        }
    }

    /**
     * @param array $params
     * @return void
     * @throws Exception
     */
    public function search_type_c(array $params): void
    {
        $rep_playable = $this->_rep(Rep::PLAYABLE);
        $ent_playables = $rep_playable->getPlayables();

        Log::error( '---------- ' . __CLASS__ . '::' . __LINE__);
        (new ExException("Model not found"))->failed();

        $rep_guild = $this->_rep(Rep::GUILD);
        $ent_guilds = $rep_guild->getGuilds();
        foreach ($ent_playables as $ent_playable) {
//            Log::debug(__LINE__);
            Log::debug($ent_playable->nick_name);
            if ($ent_playable->isSolo()) {
                $ent_guild = $ent_guilds->find($ent_playable->u_guild_id);
                if ($ent_guild && !$ent_guild->isRequestPossible()) {
                    Log::debug('----- ' . $ent_guild->name . ' is not isRequestPossible');
                }
            }
        }
    }
}
