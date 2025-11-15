<?php

declare(strict_types=1);

namespace App\Core\Http\Requests;

final class ReqNone extends BaseReq
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [];
    }
}
