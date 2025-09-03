<?php

declare(strict_types=1);

namespace App\Http\Responses\Playable;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;

/**
 * ResRootIndex
 */
class ResPlayableFind implements Responsable
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
