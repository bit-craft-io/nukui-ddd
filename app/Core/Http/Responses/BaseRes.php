<?php

declare(strict_types=1);

namespace App\Core\Http\Responses;

use App\Core\Libraries\Traits\TraitDomain;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

abstract class BaseRes extends JsonResponse
{
    use TraitDomain;

    protected array $_result = [];

    abstract public function toResponse(Request $req): JsonResponse;

    /**
     * @param string $name
     * @return mixed|null
     */
    public function __get(string $name)
    {
        return $this?->_result[$name] ?? null;
    }

    /**
     * @param array $params
     * @return void
     */
    public function setParams(array $params): void
    {
        $this->_result += $params;
    }
}
