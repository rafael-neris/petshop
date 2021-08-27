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

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => '/api'], function () use ($router){
    $router->group(['prefix' => '/owners'], function () use ($router){
        $router->get('', 'OwnerController@index');
        $router->post('','OwnerController@store');
        $router->get('{id}','OwnerController@show');
        $router->put('{id}','OwnerController@update');
        $router->delete('{id}','OwnerController@destroy');
    });

    $router->group(['prefix' => '/pets'], function () use ($router) {
        $router->get('', 'PetController@index');
        $router->post('', 'PetController@store');
        $router->get('{id}', 'PetController@show');
        $router->put('{id}', 'PetController@update');
        $router->delete('{id}', 'PetController@destroy');
    });
});
    
