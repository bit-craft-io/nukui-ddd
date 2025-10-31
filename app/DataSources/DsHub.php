<?php

declare(strict_types=1);

namespace App\DataSources;

final class DsHub
{
    const string DS_ACCOUNT = DsAccount::class;

    const string DS_M_ITEM = DsMItem::class;
    const string DS_M_GACHA = DsMGacha::class;
    const string DS_M_GACHA_LOT_ENTITY = DsMGachaDrawEntity::class;

    const string DS_U_USER = DsUUser::class;
    const string DS_U_ITEM = DsUItem::class;
    const string DS_U_GACHA = DsUGacha::class;
}
