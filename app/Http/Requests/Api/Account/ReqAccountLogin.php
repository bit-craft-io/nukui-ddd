<?php

declare(strict_types=1);

namespace App\Http\Requests\Api\Account;

use App\Http\Requests\BaseReq;

/**
 * @property-read string $primary_code
 */
class ReqAccountLogin extends BaseReq
{
    public function rules(): array
    {
        return [
            'primary_code' => 'required|string',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'primary_code' => $this->header('Primary-Code'),
        ]);
    }
}
