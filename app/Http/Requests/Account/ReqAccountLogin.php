<?php

declare(strict_types=1);

namespace App\Http\Requests\Account;

use App\Core\Http\Requests\BaseReq;

/**
 * @property-read string $primary_code
 */
final class ReqAccountLogin extends BaseReq
{
    public function rules(): array
    {
        return [
            'primary_code' => 'required|string',
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'primary_code' => $this->header('Primary-Code'),
        ]);
    }
}
