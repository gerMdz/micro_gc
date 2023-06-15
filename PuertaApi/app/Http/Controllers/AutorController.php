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

    public function index(): JsonResponse
    {
        $autores = Autor::all();

        return $this->successResponde($autores);
    }

    /**
     * Crea una instancia de Autor
     * @param Request $request
     * @return Response
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
     * @return Response
     */
    public function show(string $autor): Response
    {
        $autor = Autor::findOrFail($autor);
        return $this->successResponde($autor);
    }

    /**
     * Actualiza una instancia de Autor
     * @param Request $request
     * @param Autor $autor
     * @return Response
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
     * @return Response
     */
    public function destroy(int $autor): Response
    {
        $autor = Autor::findOrFail($autor);
        $autor->delete();

        return $this->successResponde($autor);
    }

}
