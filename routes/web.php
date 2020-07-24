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
    $router->put("customer/{id}", "CustomerController@update");

    // Order
    $router->get("order", "OrderController@get");
    $router->post("order", "OrderController@create");
    $router->get("order/{id}", "OrderController@getById");
    $router->delete("order/{id}", "OrderController@delete");
    $router->put("order/{id}", "OrderController@update");

    // Product
    $router->get("product", "ProductController@get");
    $router->post("product", "ProductController@create");
    $router->get("product/{id}", "ProductController@getById");
    $router->delete("product/{id}", "ProductController@delete");
    $router->put("product/{id}", "ProductController@update");

    // Payment
    $router->get("payment", "PaymentController@get");
    $router->post("payment", "PaymentController@create");
    $router->get("payment/{id}", "PaymentController@getById");
    $router->delete("payment/{id}", "PaymentController@delete");
    $router->put("payment/{id}", "PaymentController@update");
});
