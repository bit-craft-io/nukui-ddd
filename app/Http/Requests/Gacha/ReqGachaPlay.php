<?php

declare(strict_types=1);

namespace App\Http\Requests\Gacha;

use App\Core\Http\Requests\BaseReq;

/**
 * @property-read integer $gacha_id
 */
final class ReqGachaPlay extends BaseReq
{
    public function rules(): array
    {
        return [
            'gacha_id' => 'required|integer',
        ];
    }
}
