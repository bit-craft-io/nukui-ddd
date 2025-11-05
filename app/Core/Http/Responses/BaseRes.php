<?php

declare(strict_types=1);

namespace App\Core\Http\Responses;

use Illuminate\Http\JsonResponse;

abstract class BaseRes extends JsonResponse
{
    protected array $_result = [];

    /**
     * @param array $params
     * @return void
     */
    public function init(array $params = []): void
    {
        $this->_result = $params;
    }

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
