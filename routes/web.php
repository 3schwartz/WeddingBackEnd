<?php

use Illuminate\Http\Request;

$router->group(['prefix'=>'auth'], function () use ($router) {
    $router->post('/login', 'AuthController@login');
    $router->post('/logout', 'AuthController@logout');
    $router->post('/register', 'AuthController@register');
});

// $router->group(['prefix' => 'databaseactions'], function() use ($router) {
//     $router->get('/migrate/{key}', 'DatabaseController@migrate');
//     $router->get('/rollback/{key}', 'DatabaseController@rollback');
//     $router->get('/seed/{key}', 'DatabaseController@seed');
//     $router->get('/migrateFresh/{key}', 'DatabaseController@migrateFresh');
// });

$router->get('/checkadmin', 'AdminController@checkAdmin');

$router->group(['middleware' => ['auth:api']], function() use ($router) {

    $router->get('/isadmin', 'AdminController@isAdmin');

    $router->group(['prefix' => 'guest'], function() use ($router) {
        $router->get('/index', 'GuestController@index');
        $router->get('/', 'GuestController@show');
        $router->get('/export', 'GuestController@export');
        $router->post('/create', 'GuestController@create');
        $router->post('/update', 'GuestController@update');
        $router->delete('/{id}', 'GuestController@delete');
    });
    
    $router->group(['prefix' => 'wish'], function() use ($router) {
        $router->get('/', 'WishController@show');
        $router->post('/create', 'WishController@create');
        $router->post('/update', 'WishController@update');
        $router->delete('/{id}', 'WishController@delete');
    });
    
    $router->group(['prefix' => 'address'], function() use ($router) {
        $router->get('/', 'AddressController@show');
        $router->get('/{id}', 'AddressController@read');
        $router->post('/create', 'AddressController@create');
        $router->post('/update', 'AddressController@update');
        $router->delete('/{id}', 'AddressController@delete');
    });

    $router->group(['prefix' => 'gueststate'], function() use ($router) {
        $router->get('/', 'GuestStateController@show');
    });

    $router->group(['prefix' => 'databaseactions'], function() use ($router) {
        $router->get('/migrate/{key}', 'DatabaseController@migrate');
        $router->get('/rollback/{key}', 'DatabaseController@rollback');
        $router->get('/seed/{key}', 'DatabaseController@seed');
        $router->get('/migrateFresh/{key}', 'DatabaseController@migrateFresh');
    });
});

$router->get('/ping', function () {
    return json_encode(array('pong' => date('Y-m-d-h-i-s')));
});