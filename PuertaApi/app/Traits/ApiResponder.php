<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Laravel\Lumen\Http\ResponseFactory;


trait ApiResponder
{
    /**
     * @param string|array $data
     * @param int $code
     * @return Response|ResponseFactory
     */
    public function successResponde($data, int $code = Response::HTTP_OK)
    {
        return response($data, $code)->header('Content-Type', 'application/json');
    }

    /**
     * @param string|array $mensaje
     * @param int $code
     * @return JsonResponse
     */
    public function errorResponde($mensaje, int $code): JsonResponse
    {
        return response()->json(['error' => $mensaje, 'code' => $code], $code);
    }

    /**
     * @param string|array $mensaje
     * @param int $code
     * @return Response|ResponseFactory
     */
    public function errorMensaje($mensaje, int $code)
    {
        return response( $mensaje,  $code)->header('Content-Type', 'application/json');
    }
}
