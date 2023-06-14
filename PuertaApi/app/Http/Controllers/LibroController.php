<?php

namespace App\Http\Controllers;

use App\Models\Libro;
use App\Traits\ApiResponder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Laravel\Lumen\Routing\Controller as BaseController;

class LibroController extends BaseController
{

    use ApiResponder;

    /**
     * Lista de Libroes
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $libro = Libro::all();

        return $this->successResponde($libro);
    }

    /**
     * Crea una instancia de Libro
     * @param Request $request
     * @return JsonResponse
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        $rules = [
            'nombre' => 'required|max:255',
            'genero' => 'required|max:255|in:masculino,femenino',
            'pais' => 'required|max:255',
        ];

        $this->validate($request, $rules);

        $libro = Libro::create($request->all());

        return $this->successResponde($libro, Response::HTTP_CREATED);

    }

    /**
     * Muestra los datos de un Libro
     * @param string $libro
     * @return JsonResponse
     */
    public function show(string $libro): JsonResponse
    {
        $libro = Libro::findOrFail($libro);
        return $this->successResponde($libro);
    }

    /**
     * Actualiza una instancia de Libro
     * @param Request $request
     * @param Libro $libro
     * @return JsonResponse
     */
    public function update(Request $request, string $libro)
    {
        $rules = [
            'nombre' => 'max:255',
            'genero' => 'max:255|in:masculino,femenino',
            'pais' => 'max:255',
        ];

        $this->validate($request, $rules);

        $libro = Libro::findOrFail($libro);

        $libro->fill($request->all());

        if($libro->isClean()){
            return $this->errorResponde('Por lo menos un valor debe cambiar', Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $libro->save();

        return $this->successResponde($libro);
    }

    /**
     * Remueve un Libro
     * @param int $libro
     * @return JsonResponse
     */
    public function destroy(int $libro): JsonResponse
    {
        $libro = Libro::findOrFail($libro);
        $libro->delete();

        return $this->successResponde($libro);
    }

}
