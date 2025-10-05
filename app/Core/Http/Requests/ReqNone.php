<?php

declare(strict_types=1);

namespace App\Core\Http\Requests;

class ReqNone extends BaseReq
{
    public function rules(): array
    {
        return [];
    }
}
