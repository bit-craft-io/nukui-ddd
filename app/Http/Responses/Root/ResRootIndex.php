<?php

declare(strict_types=1);

namespace App\Http\Responses\Root;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;

/**
 * ResRootIndex
 */
class ResRootIndex implements Responsable
{
    //use LibDomain;

    /**
     * @param $request
     * @return JsonResponse
     */
    public function toResponse($request): JsonResponse
    {
        $properties = [];
        return response()->json($properties);
    }
}
