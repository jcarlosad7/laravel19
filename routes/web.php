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
Auth::routes(['verify'=>'true']);

Route::group(['middleware'=>'verified'],function(){
    Route::resource('/entrada','EntradaController')->middleware('language');
    Route::post('/entrada/comentario','EntradaController@comentarioGuardar')->name('comentario.guardar');  
});
Route::get('/', 'BlogController@index')->name('blog.buscar');
//Route::get('/{texto?}', 'BlogController@index')->name('blog.buscar');
Route::get('/blog/{id}', 'BlogController@show')->name('blog.mostrar');
Route::get('/home', 'HomeController@index')->name('home');
