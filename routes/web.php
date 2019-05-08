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
	route::Post('manutencao', 'ManutencaoController@AlterarStatus')->name('altera-status');
	Route::resource('chamados', 'ChamadoController');
	Route::get('manutencao', 'ManutencaoController@index')->name('index-manutencao');
});

Route::prefix('usuario')->group(function () {
	route::get('/', 'UsuarioController@index')->name('usuario');
	route::get('login', 'Auth\UsuarioLoginController@login')->name('login-usuario');
	route::Post('login', 'Auth\UsuarioLoginController@loginUsuario')->name('login-submit');
	route::get('register', 'UsuarioController@registerIndex')->name('register-u');
	route::Post('register', 'UsuarioController@registerUsuario')->name('register-usuario');
	Route::resource('problemas', 'ProblemaController');
	Route::resource('equipamento', 'EquipamentoController'); 
	Route::get('lista-equipamento', 'ListarEquipamentoController@index')->name('lista-equipamento-index');
	route::Post('lista-equipamento', 'EquipamentoController@manutencao')->name('equipamento-manutencao');
	route::get('lista-problemas', 'ProblemaController@indexLista')->name('lista-problemas');
	route::Post('lista-problemas', 'ProblemaController@chamado')->name('problema-chamado');

});

Route::prefix('supervisor')->group(function () {
	route::get('/', 'SupervisorController@index')->name('bolsista');
	route::get('login', 'Auth\SupervisorLoginController@login')->name('login-supervisor');
	route::Post('login', 'Auth\SupervisorLoginController@loginBolsista')->name('login-submit-supervisor');
	route::get('register', 'SupervisorController@registerIndex')->name('supervisor-b');
	route::Post('register', 'SupervisorController@registerBolsista')->name('register-supervisor');
});

Route::post('logout', 'Auth\LoginController@logout');