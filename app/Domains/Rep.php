<?php

namespace App\Domains;

use App\Domains\Guild\RepGuild;
use App\Domains\Playable\RepPlayable;
use App\Domains\Player\RepPlayer;

/**
 * リポジトリのインデックス
 */
class Rep
{
    const string PLAYER = RepPlayer::class;
    const string PLAYABLE = RepPlayable::class;
    const string GUILD = RepGuild::class;
}
