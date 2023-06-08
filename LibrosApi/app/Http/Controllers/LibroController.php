<?php

namespace App\Http\Controllers;

use App\Models\Libro;
use App\Traits\ApiResponder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class LibroController extends Controller
{
    use ApiResponder;

    /**
     * Lista de libros
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $libros = Libro::all();

        return $this->successResponde($libros);
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

        $Libro = Libro::create($request->all());

        return $this->successResponde($Libro, Response::HTTP_CREATED);

    }

    /**
     * Muestra los datos de un Libro
     * @param string $Libro
     * @return JsonResponse
     */
    public function show(string $Libro): JsonResponse
    {
        $Libro = Libro::findOrFail($Libro);
        return $this->successResponde($Libro);
    }

    /**
     * Actualiza una instancia de Libro
     * @param Request $request
     * @param Libro $Libro
     * @return JsonResponse
     */
    public function update(Request $request, string $Libro)
    {
        $rules = [
            'nombre' => 'max:255',
            'genero' => 'max:255|in:masculino,femenino',
            'pais' => 'max:255',
        ];

        $this->validate($request, $rules);

        $Libro = Libro::findOrFail($Libro);

        $Libro->fill($request->all());

        if($Libro->isClean()){
            return $this->errorResponde('Por lo menos un valor debe cambiar', Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $Libro->save();

        return $this->successResponde($Libro);
    }

    /**
     * Remueve un Libro
     * @param int $Libro
     * @return JsonResponse
     */
    public function destroy(int $Libro): JsonResponse
    {
        $Libro = Libro::findOrFail($Libro);
        $Libro->delete();

        return $this->successResponde($Libro);
    }
}
