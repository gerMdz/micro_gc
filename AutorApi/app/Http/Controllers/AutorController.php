<?php

namespace App\Http\Controllers;

use App\Models\Autor;
use App\Traits\ApiResponder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
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
     * @return void
     */
    public function store(Request $request)
    {

    }

    /**
     * Muestra los datos de un Autor
     * @param Autor $autor
     * @return void
     */
    public function show(Autor $autor)
    {

    }

    /**
     * Actualiza una instancia de Autor
     * @param Request $request
     * @param Autor $autor
     * @return void
     */
    public function update(Request $request, Autor $autor)
    {

    }

    /**
     * Remueve un Autor
     * @param Autor $autor
     * @return void
     */
    public function destroy(Autor $autor)
    {

    }

}
