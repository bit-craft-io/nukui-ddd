<?php

namespace App\_Demo\Http\Requests\Demo;

use App\Core\Http\Requests\BaseReq;

/**
 * @property-read integer $id
 * @property-read string $name
 */
class ReqDemoCase01 extends BaseReq
{
    public function rules(): array
    {
        return [
            'id' => 'required|integer',
            'name' => 'string',
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'id' => 1,
            'name' => 'optional',
        ]);
    }
}
