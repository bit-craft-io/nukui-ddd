<?php

declare(strict_types=1);

namespace App\Core\Http\Responses;

use Illuminate\Http\JsonResponse;

abstract class BaseRes extends JsonResponse
{
    protected array $_result = [];

    public function init(array $params = []): void
    {
        $this->_result = $params;
    }

    public function __get(string $name)
    {
        return $this?->_result[$name] ?? null;
    }

    public function setParams(array $params): void
    {
        $this->_result += $params;
    }
}
