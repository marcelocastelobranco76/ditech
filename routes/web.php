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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

/** Rotas para as areas de gerenciamento das salas. Só os administradores têm acesso. **/ 

	Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function() { 
	    Route::any('/salas','SalaController@index');

		Route::get('salas/cadastrar', 'SalaController@create');

		Route::post('salas', 'SalaController@store');

		Route::get('salas/{id}/editar', 'SalaController@edit');

		Route::patch('/salas/{id}', 'SalaController@update');

		Route::delete('salas/{id}', 'SalaController@destroy');	
		
		Route::any('/reservas','ReservaController@index');
	
		Route::delete('reservas/{id}', 'ReservaController@destroy');


	});
	
	Route::get('logout', 'Auth\LoginController@logout'); /** Rota para logout **/

	Route::any('/salas','SalaController@index');

	Route::any('/reservas','ReservaController@index');

	Route::get('reservas/cadastrar', 'ReservaController@create');

	Route::post('reservas', 'ReservaController@store');
	
	Route::delete('reservas/{id}', 'ReservaController@destroy');	


