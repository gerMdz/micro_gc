<?php

namespace App\Http\Controllers;

use App\Models\Autor;
use App\Traits\ApiResponder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Laravel\Lumen\Routing\Controller as BaseController;

class AutorController extends BaseController
{

    use ApiResponder;

    /**
     * Lista de autores
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $autores = Autor::all();

        return $this->successResponde($autores);
    }

    /**
     * Crea una instancia de Autor
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

        $autor = Autor::create($request->all());

        return $this->successResponde($autor, Response::HTTP_CREATED);

    }

    /**
     * Muestra los datos de un Autor
     * @param string $autor
     * @return JsonResponse
     */
    public function show(string $autor): JsonResponse
    {
        $autor = Autor::findOrFail($autor);
        return $this->successResponde($autor);
    }

    /**
     * Actualiza una instancia de Autor
     * @param Request $request
     * @param Autor $autor
     * @return JsonResponse
     */
    public function update(Request $request, string $autor)
    {
        $rules = [
            'nombre' => 'max:255',
            'genero' => 'max:255|in:masculino,femenino',
            'pais' => 'max:255',
        ];

        $this->validate($request, $rules);

        $autor = Autor::findOrFail($autor);

        $autor->fill($request->all());

        if($autor->isClean()){
            return $this->errorResponde('Por lo menos un valor debe cambiar', Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $autor->save();

        return $this->successResponde($autor);
    }

    /**
     * Remueve un Autor
     * @param int $autor
     * @return JsonResponse
     */
    public function destroy(int $autor): JsonResponse
    {
        $autor = Autor::findOrFail($autor);
        $autor->delete();

        return $this->successResponde($autor);
    }

}
