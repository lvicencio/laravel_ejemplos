<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Route::get('/', ['as' => 'home', function () {
//     return view('home');
// }]);
Route::get('/', function () {
    return view('home');
});


Route::post('/agregarproducto', 'ProductoController@agregarproducto');
Route::get('/getproductos', 'ProductoController@getproductos');
Route::get('/ver_producto/{id}', 'ProductoController@getproducto');
Route::post('/editarproducto', 'ProductoController@updateproducto');
Route::get('/borrar_producto/{id}', 'ProductoController@deleteproducto');
