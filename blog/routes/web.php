<?php

 // App\User::create([
 // 	'name' => 'borrame',
 // 	'email'=> 'borrame@gmail.com',
 // 	'password'=> bcrypt('123123'),
 	
 // ]);
 // App\User::create([
 // 	'name' => 'Luis',
 // 	'email'=> 'lvicencio@gmail.com',
 // 	'password'=> bcrypt('123123'),
 // 	'role_id' => '1'
 // ]);
 // App\User::create([
 // 	'name' => 'prueba',
 // 	'email'=> 'prueba@gmail.com',
 // 	'password'=> bcrypt('123123'),
 // 	'role_id' => '2'
 // ]);
 // App\User::create([
 // 	'name' => 'estudiante',
 // 	'email'=> 'estudiante@gmail.com',
 // 	'password'=> bcrypt('123123'),
 // 	'role' => 'estudiante'
 // ]);
 //  App\Role::create([
 // 	'name' => 'admin',
 // 	'display'=> 'administrador del sistema',
 // 	'description'=> 'administrador del sistema'
 //  ]);
 // App\Role::create([
 // 	'name' => 'mod',
 // 	'display'=> 'Moderador',
 // 	'description'=> 'Moderador del sistema'
 // ]);

Route::get('/', ['as' => 'home', function () {
    return view('home');
}]);

Route::get('/saludo', ['as' => 'mensaje', function () {
    return view('saludo');
}]);


Route::resource('mensajes','MensajesController');
Route::resource('usuarios','UsersController');

Route::get('/login',["as" => "login", "uses" => 'Auth\LoginController@showLoginForm']);
Route::post('/login','Auth\LoginController@login');

Route::get('/logout','Auth\LoginController@logout');