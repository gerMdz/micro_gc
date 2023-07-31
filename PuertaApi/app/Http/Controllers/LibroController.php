<?php

namespace App\Http\Controllers;

use App\Services\AutorService;
use App\Services\LibroService;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Laravel\Lumen\Routing\Controller as BaseController;


class LibroController extends BaseController
{

    use ApiResponder;

    /**
     * @var LibroService
     */
    private $libroService;
    /**
     * @var AutorService
     */
    private $autorService;


    /**
     * @param LibroService $libroService
     * @param AutorService $autorService
     */
    public function __construct(LibroService $libroService, AutorService $autorService)
    {

        $this->libroService = $libroService;
        $this->autorService = $autorService;
    }

    public function index()
    {

        return $this->successResponde($this->libroService->getLibros());
    }

    /**
     * Crea una instancia de Libro
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->autorService->getAutor($request->autor_id);

        return $this->successResponde($this->libroService->altaLibro($request->all(), Response::HTTP_CREATED));
    }

    /**
     * Muestra los datos de un Libro
     * @param string $libro
     * @return Response
     */
    public function show(string $libro): Response
    {
        return $this->successResponde($this->libroService->getLibro($libro));
    }

    /**
     * Actualiza una instancia de Libro
     * @param Request $request
     * @param string $libro
     * @return Response
     */
    public function update(Request $request, string $libro)
    {
        return $this->successResponde($this->libroService->modificaLibro($request->all(),$libro));
    }

    /**
     * Remueve un Libro
     * @param int $libro
     * @return Response
     */
    public function destroy(int $libro): Response
    {
        return $this->successResponde($this->libroService->borraLibro($libro));
    }

}
