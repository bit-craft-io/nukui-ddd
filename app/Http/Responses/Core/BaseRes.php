<?php

declare(strict_types=1);

namespace App\Http\Responses\Core;

use Illuminate\Http\JsonResponse;

abstract class BaseRes extends JsonResponse
{
    public function __construct()
    {
        $this->setParams();
        parent::__construct();
    }

    protected array $_props = [];

    public function init(array $props = []): void
    {
        $this->_props = $props;
    }

    public function __get(string $name)
    {
        return $this?->_props[$name] ?? null;
    }

    public function setParams(): void
    {
        $this->_props += ParamRes::all();
    }
}
