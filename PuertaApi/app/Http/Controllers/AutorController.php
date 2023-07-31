<?php

namespace App\Http\Controllers;

use App\Models\Autor;
use App\Services\AutorService;
use App\Traits\ApiResponder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class AutorController extends Controller
{

    use ApiResponder;

    /**
     * @var AutorService
     */
    private $autorService;

    /**
     * @param AutorService $autorService
     */
    public function __construct(AutorService $autorService)
    {
        $this->autorService = $autorService;
    }

    public function index()
    {

        return $this->successResponde($this->autorService->getAutores());
    }

    /**
     * Crea una instancia de Autor
     * @param Request $request
     * @return Response
     */
    public function store(Request $request): Response
    {
        return $this->successResponde($this->autorService->altaAutor($request->all(), Response::HTTP_CREATED));

    }

    /**
     * Muestra los datos de un Autor
     * @param string $autor
     * @return Response
     */
    public function show(string $autor): Response
    {
        return $this->successResponde($this->autorService->getAutor($autor));
    }

    /**
     * Actualiza una instancia de Autor
     * @param Request $request
     * @param Autor $autor
     * @return Response
     */
    public function update(Request $request, string $autor)
    {
        return $this->successResponde($this->autorService->modificaAutor($request->all(),$autor));
    }

    /**
     * Remueve un Autor
     * @param int $autor
     * @return Response
     */
    public function destroy(int $autor): Response
    {
        return $this->successResponde($this->autorService->borraAutor($autor));
    }

}
