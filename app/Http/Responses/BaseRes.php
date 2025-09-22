<?php

namespace App\Http\Responses;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;

abstract class BaseRes extends JsonResponse
{
    protected ?array $_props = null;
    public function init(array $props = []): void
    {
        $this->_props = $props;
    }
    public function __get(string $name)
    {
        return $this?->_props[$name] ?? null;
    }
}
