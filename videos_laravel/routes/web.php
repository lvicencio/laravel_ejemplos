<?php


Route::get('/', function () {
    
    return view('welcome');
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
//rutas de Video
Route::get('/crear-video', array(
    'as' => 'crearVideo',
    'middleware' => 'auth',
    'uses' => 'VideoController@create'
));
Route::post('/guardar-video', array(
    'as' => 'guardarVideo',
    'middleware' => 'auth',
    'uses' => 'VideoController@store'
));

Route::get('/miniatura/{filename}','VideoController@getImage')->name('imageVideo');
Route::get('/video/{video_id}','VideoController@show')->name('detalleVideo');
Route::get('/video-file/{filename}','VideoController@getVideo')->name('fileVideo');
Route::get('/delete-video/{video_id}','VideoController@destroy')->name('deleteVideo')->middleware('auth');
Route::get('/editar-video/{video_id}','VideoController@edit')->name('editarVideo')->middleware('auth');
Route::post('/update-video/{video_id}','VideoController@update')->name('updateVideo')->middleware('auth');
Route::get('/buscar/{buscar?}','VideoController@buscar')->name('buscarVideo');
//comenario
Route::post('/comment','CommentController@store')->name('comment')->middleware('auth');
Route::get('/delete-comment/{comment_id}','CommentController@destroy')->name('deleteComment')->middleware('auth');
//canal del usuario
Route::get('/canal/{user_id}','UserController@canal')->name('userCanal');