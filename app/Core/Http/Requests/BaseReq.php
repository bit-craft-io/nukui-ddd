<?php

declare(strict_types=1);

namespace App\Core\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property-read ?integer $user_id
 */
abstract class BaseReq extends FormRequest
{
    protected object $_props;
    public function params(): array
    {
        return $this->toArray();
    }

    protected function prepareForValidation(): void
    {
        $this->merge(['user_id' => ($this->user()->id ?? null)]);
    }

    // @note バリデーション後に初期化
    protected function passedValidation(): void
    {
        $this->_props = json_decode(json_encode($this->toArray() ?? []));
    }

    public function __get($key)
    {
        return $this->_props->$key ?? null;
    }
}
