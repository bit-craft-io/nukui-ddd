<?php

declare(strict_types=1);

namespace App\Http\Requests\Root;

//use _deletes\AppLibExRequest;
use Illuminate\Foundation\Http\FormRequest;

class ReqRootIndex extends FormRequest
{
    //use AppLibExRequest;
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'hoge_id' => 'required|integer',
        ];
    }

    //protected function prepareForValidation(): void
    //{
    //    $this->_exRequest()->init($this);
    //    $this->_exRequest()->optionalDefault('hoge_id', 1);
    //
    //    $this->_exRequest()->fixParamType($this->rules());
    //}
}
