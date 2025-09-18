<?php

namespace App\Http\Requests\Api\Account;

use App\Http\Requests\BaseReq;

class ReqAccountLogin extends BaseReq
{
    public function rules(): array
    {
        return [
            'email' => 'required|string',
            'password' => 'required|string',
        ];
    }
}
