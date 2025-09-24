<?php

declare(strict_types=1);

namespace App\Http\Responses;

use Illuminate\Http\JsonResponse;

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
