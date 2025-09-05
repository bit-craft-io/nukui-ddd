<?php

declare(strict_types=1);

namespace App\Http\Applications;

class AppRoot extends BaseApp
{
    /**
     * @param array $params
     * @return void
     */
    public function index(array $params): void
    {
        $this->_useTransaction();
        // @note find と save が同時はありえないけど確認の為

//        // @note リスト操作の時はdata sourceより取得して、ドメインモデルで判定処理
//        $u_playables = $this->_ds(Ds::U_PLAYABLE)->getDebugAll();
//        $u_playable = $this->_ds(Ds::U_PLAYABLE)->findOrFailed(1);
////Log::debug(__LINE__ . '::' . $u_playable->type_play_style->value);
////Log::debug($u_playable->type_play_style->isSolo() ? 'true' : 'false');
//        foreach ($u_playables as $u_playable) {
//            // @note reSetは、空のエンティティを使いまわす
////            Log::debug(__CLASS__ . '::' . __LINE__ . '::' . json_encode($u_playable->toArray()));
//            $ent = $rep_playable->reSet($u_playable->toArray());
//            //$ent->getPlayStyle();
////            Log::debug(json_encode($ent->isSolo()));
//            Log::debug($ent->isSolo());
////            if ($ent->isSolo()) {
////                Log::debug('solo');
////            } else {
////                Log::debug('not solo');
////            }
////            if (!$ent->getPlayStyle()) {
////                // @note リストの内容の変更
////                $u_playable->stamina_count = 100;
////            }
////            Log::debug(__CLASS__ . '::' . __LINE__ . '::' . json_encode($u_playable));
//        }
//        // @note リストを一括変更
//        //$this->_ds(Ds::DS_U_PLAYABLE)->upsert($u_playables);
//
//        // TODO stickyとTransactionの確認
//        //$rep_playable->findAndSave(1);
//
//        //        $ent_playable = $rep_playable->findOrFailed(1);
//        //        $ent_playable->modifyNickName('20250312');
//        //        $rep_playable->persist($ent_playable);
    }
}
