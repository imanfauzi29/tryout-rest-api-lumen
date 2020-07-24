<?php

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

$router->group(["prefix" => "api/v1"], function () use ($router) {
    // Customer
    $router->get("customer", "CustomerController@get");
    $router->post("customer", "CustomerController@create");
    $router->get("customer/{id}", "CustomerController@getById");
    $router->delete("customer/{id}", "CustomerController@delete");
    $router->patch("customer/{id}", "CustomerController@patch");
});
