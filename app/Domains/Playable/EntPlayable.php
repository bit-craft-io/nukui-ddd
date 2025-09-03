<?php

declare(strict_types=1);

namespace App\Domains\Playable;

use App\Domains\BaseEnt;
use App\Domains\VOs\VoStamina;
use App\Models\Enums\TypePlayStyle;
use Exception;
use Illuminate\Support\Facades\Log;

/**
 * このクラスの要約
 *
 * @method _id(int $value)
 * @method _nick_name(?string $value)
 * @method _stamina_count(int $value)
 * @method _type_play_style(TypePlayStyle $value)
 * @method _u_guild_id(int $value)
 *
 * @property-read int $id
 * @property-read ?string $nick_name
 * @property-read int $stamina_count
 * @property-read TypePlayStyle $type_play_style
 * @property-read VoStamina $vo_stamina
 * @property-read int $u_guild_id
 */
class EntPlayable extends BaseEnt
{
    /**
     * @var array|array[]
     */
    protected array $_find_vos = [
        //'_vo_stamina' => [VoStamina::class, ['_stamina_count']],
        '_vo_stamina' => [VoStamina::class, ['_stamina_count']],
    ];

    /**
     * @return VoStamina
     * @throws Exception
     */
    private function _voStamina(): VoStamina
    {
        // @note $_find_vos の設定をして property-read の call 時に作成する為
        //  このメソッドの様な作成は不要
        // @note vo はプロトタイプパターンで作成した後、作成済の配列に設定し、次回以降は配列から取得
        // @note vo を再作成する場合は clear もしくは flush を実行
        //return $this->_findVo(VoStamina::class, ['_stamina_count' => $this->_stamina_count]);
    }

    /**
     * @return bool
     */
    public function isRegisteredNickName(): bool
    {
        return isset($this->nick_name);
    }

    /**
     * @param int $count
     * @return void
     * @throws Exception
     */
    public function consumeStamina(int $count): void
    {
        $this->vo_stamina->consume($count);
    }

    /**
     * @param int $count
     * @return void
     * @throws Exception
     */
    public function recoveryStamina(int $count): void
    {
        $this->vo_stamina->recovery($count);
    }

    /**
     * @return bool
     */
    public function isSolo(): bool
    {
        return $this->type_play_style->isSolo();
    }
}
