<?php
/*
Date: 07-03-2020,
Description: Membuat routing baru,
Developer: rizal,
Status: Create
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->post('/register', 'AuthController@register');
$router->post('/login', 'AuthController@login');

$router->get('/user', 'UserController@index');

$router->get("posts", "PostController@index");
$router->post("posts/create", "PostController@store");
$router->put('posts/update', 'PostController@update');
$router->delete('posts/{id}', 'PostController@destroy');

$router->get('barang', 'BarangController@index');
$router->post('barang/create', 'BarangController@create');
$router->put('barang/update', 'BarangController@update');
$router->delete('barang/{id}', 'BarangController@destroy');

$router->get('stok', 'StokController@index');
$router->post('stok/create', 'StokController@store');
$router->put('stok/update', 'StokController@update');
$router->delete('stok/{id}', 'StokController@destroy');

$router->get('stok', 'StokController@index');
$router->post('stok/create', 'StokController@store');
$router->put('stok/update', 'StokController@update');
$router->delete('stok/{id}', 'StokController@destroy');

$router->get('pembelian', 'PembelianController@index');
$router->post('pembelian/create', 'PembelianController@store');
$router->get('/pembelian/{id}', 'Pembelian@getOne');

$router->get('penjualan', 'PenjualanController@index');
$router->post('penjualan/create', 'PenjualanController@store');
$router->get('/pembelian/{id}', 'Pembelian@getOne');


