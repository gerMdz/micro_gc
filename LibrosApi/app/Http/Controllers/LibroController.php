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
            'titulo' => 'required|max:255',
            'descripcion' => 'required|max:255',
            'precio' => 'required|min:1',
            'autor_id' => 'required|min:1',
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
     * @param string $libro
     * @return JsonResponse
     * @throws ValidationException
     */
    public function update(Request $request, string $libro)
    {
        $rules = [
            'titulo' => 'max:255',
            'descripcion' => 'max:255',
            'precio' => 'min:1',
            'autor_id' => 'min:1',
        ];

        $this->validate($request, $rules);


        $libro = Libro::findOrFail($libro);

        $libro->fill($request->all());

        if ($libro->isClean()) {
            return $this->errorResponde('Por lo menos un valor debe cambiar', Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $libro->save();

        return $this->successResponde($libro);
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
