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

$router->get('/libros', 'LibroController@index');
$router->post('/libros', 'LibroController@store');
$router->get('/libros/{libro}', 'LibroController@show');
$router->put('/libros/{libro}', 'LibroController@update');
$router->patch('/libros/{libro}', 'LibroController@update');
$router->delete('/libros/{libro}', 'LibroController@destroy');
