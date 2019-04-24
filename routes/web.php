<?php

//Route::get('/chamados', 'ChamadoController@tela');
//Route::get('/equipamento', 'EquipamentoController@create');

//route::post('cadastroEquipamento', 'EquipamentosController@store')->name('cadastro');

//route::post('cadastroChamados', 'ChamadoController@criarChamado')->name('cadastro.chamado');

route::get('/', function () {
	return view('welcome');
})->name('index');


//localhost:8000/usuario -- exibe a tela com as info do usuario


//localhost:8000/bolsista -- exibe a tela com as info do bolsista
route::get('bolsista', 'BolsistaController@index')->name('bolsista');
route::get('login-bolsista', 'BolsistaController@login')->name('login-bolsista');
route::Post('login-bolsista', 'BolsistaController@postLogin')->name('login-submit-bolsista');
route::get('register-bolsista', 'BolsistaController@registerIndex')->name('register-b');
route::Post('register-bolsista', 'BolsistaController@registerBolsista')->name('register-bolsista');

//so entram nesses quando tiver logado
//equipamentos.store....
//equipamentos.create...

Route::resource('manutencao', 'ManutencaoController');
//route::get('manutencao', 'BolsistaController@registerIndex')->name('register-b');
Route::resource('problemas', 'ProblemaController');
route::get('sol-manutencao', 'ManutencaoController@index');






route::get('lista-problemas', 'ProblemaController@indexLista')->name('lista-problemas');
route::Post('lista-problemas', 'ProblemasController@chamado')->name('problema-chamado');

Auth::routes();

Route::get('home', 'HomeController@index')->name('home');

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

	Route::resource('equipamento', 'EquipamentoController'); 
	Route::resource('lista-equipamento', 'ListarEquipamentoController');
	Route::resource('chamado', 'ChamadoController');

	route::Post('lista-equipamento', 'EquipamentoController@manutencao')->name('equipamento-manutencao');
});