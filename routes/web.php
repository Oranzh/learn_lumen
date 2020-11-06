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



$router->get('posts',  [  'uses' => 'PostController@index', 'middleware' => ['throttle:5,2',  'permission:super_admin&admin']]);
$router->get('posts/{id}', [ 'as' => 'profile', 'uses' => 'PostController@show', 'middleware' => 'cors']);
$router->post('posts', 'PostController@create');
$router->put('posts', 'PostController@update');




$router->get('/', function () use ($router) {
    return redirect()->route('profile', ['id' => 2]);
});

// API route group
$router->group(['prefix' => 'user'], function () use ($router) {
    // Matches "/user/register
    $router->post('register', 'AuthController@register');

    // Matches "/user/login
    $router->post('login', 'AuthController@login');
    $router->get('profile', 'AuthController@profile');
    $router->get('permission', 'AuthController@permission');
});
