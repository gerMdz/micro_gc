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
     * @param string $mensaje
     * @param int $code
     * @return JsonResponse
     */
    public function errorResponde(string $mensaje, int $code)
    {
        return response()->json(['error' => $mensaje, 'code' => $code], $code);
    }
}
