<?php

route::get('/', function () {
	return view('welcome');
})->name('index');


Auth::routes();

Route::get('home', 'HomeController@index')->name('home');

Route::prefix('bolsista')->group(function () {
	route::get('/', 'BolsistaController@index')->name('bolsista');
	route::get('login', 'Auth\BolsistaLoginController@login')->name('login-bolsista');
	route::Post('login', 'Auth\BolsistaLoginController@loginBolsista')->name('login-submit-bolsista');
	route::get('register', 'BolsistaController@registerIndex')->name('register-b');
	route::Post('register', 'BolsistaController@registerBolsista')->name('register-bolsista');
	Route::resource('chamados', 'ChamadoController');
	Route::resource('manutencao', 'ManutencaoController');
});

Route::prefix('usuario')->group(function () {
	//Route::get('/', 'AdminController@index')->name('admin.dashboard');
	//Route::get('dashboard', 'AdminController@index')->name('admin.dashboard');
	//Route::get('register', 'AdminController@create')->name('admin.register');
	//Route::post('register', 'AdminController@store')->name('admin.register.store');
	//Route::get('login', 'Auth\Admin\LoginController@login')->name('admin.auth.login');
	//Route::post('login', 'Auth\Admin\LoginController@loginAdmin')->name('admin.auth.loginAdmin');
	//Route::post('logout', 'Auth\Admin\LoginController@logout')->name('admin.auth.logout');

	route::get('/', 'UsuarioController@index')->name('usuario');
	route::get('login', 'Auth\UsuarioLoginController@login')->name('login-usuario');
	route::Post('login', 'Auth\UsuarioLoginController@loginUsuario')->name('login-submit');
	route::get('register', 'UsuarioController@registerIndex')->name('register-u');
	route::Post('register', 'UsuarioController@registerUsuario')->name('register-usuario');
	/*Rotas de funcionalidades*/
	Route::resource('problemas', 'ProblemaController');
	Route::resource('equipamento', 'EquipamentoController'); 
	Route::resource('lista-equipamento', 'ListarEquipamentoController');
	route::Post('lista-equipamento', 'EquipamentoController@manutencao')->name('equipamento-manutencao');
	route::get('lista-problemas', 'ProblemaController@indexLista')->name('lista-problemas');
	route::Post('lista-problemas', 'ProblemasController@chamado')->name('problema-chamado');

});

Route::post('logout', 'Auth\LoginController@logout');