<?php

declare(strict_types=1);

namespace App\Http\Requests\Core;

class ReqNone extends BaseReq
{
    public function rules(): array
    {
        return [];
    }
}
