<?php

declare(strict_types=1);

namespace App\Domains;

use App\Domains\Gacha\Service\SvcGacha;

final class SvcHub
{
    const string SVC_GACHA_LOT = SvcGacha::class;
}
