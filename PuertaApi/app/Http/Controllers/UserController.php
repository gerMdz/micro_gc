<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\ApiResponder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    use ApiResponder;

    /**
     * Lista de users
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $users = User::all();

        return $this->validResponde($users);
    }

    /**
     * Crea una instancia de User
     * @param Request $request
     * @return JsonResponse
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users, email',
            'password' => 'required|min:8|confirmed',
        ];

        $this->validate($request, $rules);

        $data = $request->all();
        $data['password'] = Hash::make($request->password);


        $user = User::create($data);

        return $this->successResponde($user, Response::HTTP_CREATED);

    }

    /**
     * Muestra los datos de un User
     * @param string $user
     * @return JsonResponse
     */
    public function show(string $user): JsonResponse
    {
        $user = User::findOrFail($user);
        return $this->successResponde($user);
    }

    /**
     * Actualiza una instancia de User
     * @param Request $request
     * @param string $user
     * @return JsonResponse
     * @throws ValidationException
     */
    public function update(Request $request, string $user)
    {
        $rules = [
            'name' => 'max:255',
            'email' => 'email|unique:users, email,' .$user,
            'password' => 'min:8|confirmed',
        ];

        $this->validate($request, $rules);

        $user = User::findOrFail($user);

        $user->fill($request->all());
        if ($request->has('password')) {
            $user->password = Hash::make($request->password);
        }
        if ($request->has('email')) {
                $user->email = $request->email;
            }

        if ($user->isClean()) {
            return $this->errorResponde('Por lo menos un valor debe cambiar', Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $user->save();

        return $this->successResponde($user);
    }

    /**
     * Remueve un User
     * @param int $user
     * @return JsonResponse
     */
    public function destroy(int $user): JsonResponse
    {
        $user = User::findOrFail($user);
        $user->delete();

        return $this->successResponde($user);
    }
}
