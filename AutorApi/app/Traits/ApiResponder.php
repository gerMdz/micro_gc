<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;


trait ApiResponder
{
    /**
     * @param string|array $data
     * @param int $code
     * @return JsonResponse
     */
    public function successResponde($data, int $code = 200): JsonResponse
    {
        return response()->json(['data' => $data], $code);
    }

    /**
     * @param string|array $mensaje
     * @param int $code
     * @return JsonResponse
     */
    public function errorResponde( $mensaje, int $code): JsonResponse
    {
        return response()->json(['error' => $mensaje, 'code' => $code], $code);
    }
}
