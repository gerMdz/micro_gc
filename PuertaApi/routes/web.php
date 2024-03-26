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

//$router->get('/', function () use ($router) {
//    return $router->app->version();
//});
$router->group(['middleware' => 'client.credentials'], function () use ($router) {


// Autores
    $router->get('/autores', 'AutorController@index');
    $router->post('/autores', 'AutorController@store');
    $router->get('/autores/{autor}', 'AutorController@show');
    $router->put('/autores/{autor}', 'AutorController@update');
    $router->patch('/autores/{autor}', 'AutorController@update');
    $router->delete('/autores/{autor}', 'AutorController@destroy');

// Libros
    $router->get('/libros', 'LibroController@index');
    $router->post('/libros', 'LibroController@store');
    $router->get('/libros/{libro}', 'LibroController@show');
    $router->put('/libros/{libro}', 'LibroController@update');
    $router->patch('/libros/{libro}', 'LibroController@update');
    $router->delete('/libros/{libro}', 'LibroController@destroy');
// Users
    $router->get('/users', 'UserController@index');
    $router->post('/users', 'UserController@store');
    $router->get('/users/{user}', 'UserController@show');
    $router->put('/users/{user}', 'UserController@update');
    $router->patch('/users/{user}', 'UserController@update');
    $router->delete('/users/{user}', 'UserController@destroy');

});


