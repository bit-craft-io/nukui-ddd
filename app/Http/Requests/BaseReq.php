<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

abstract class BaseReq extends FormRequest
{
    public function params(): array
    {
        return $this->toArray();
    }
}
