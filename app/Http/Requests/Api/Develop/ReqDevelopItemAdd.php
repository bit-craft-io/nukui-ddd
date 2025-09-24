<?php

declare(strict_types=1);

namespace App\Http\Requests\Api\Develop;

use App\Http\Requests\BaseReq;

/**
 * @property-read integer $item_id
 * @property-read integer $amount
 */
class ReqDevelopItemAdd extends BaseReq
{
    public function rules(): array
    {
        return [
            'item_id' => 'required|integer',
            'amount' => 'required|integer',
        ];
    }
}
