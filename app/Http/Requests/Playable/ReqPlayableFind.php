<?php

declare(strict_types=1);

namespace App\Http\Requests\Playable;

//use _deletes\AppLibExRequest;
use Illuminate\Foundation\Http\FormRequest;

class ReqPlayableFind extends FormRequest
{
    //use AppLibExRequest;
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [];
    }

    protected function prepareForValidation(): void
    {
    }
}
