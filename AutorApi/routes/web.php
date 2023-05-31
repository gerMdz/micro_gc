<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

use App\Http\Controllers\AutorController;

$router->get('/autores', [AutorController::class, 'index']);
$router->post('/autores', [AutorController::class, 'store']);
$router->get('/autores/{autor}', [AutorController::class, 'show']);
$router->put('/autores/{autor}', [AutorController::class, 'update']);
$router->patch('/autores/{autor}', [AutorController::class, 'update']);
$router->delete('/autores/{autor}', [AutorController::class, 'destroy']);

