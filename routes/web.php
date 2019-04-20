<?php

//Route::get('/chamados', 'ChamadoController@tela');
//Route::get('/equipamento', 'EquipamentoController@create');

//route::post('cadastroEquipamento', 'EquipamentosController@store')->name('cadastro');

//route::post('cadastroChamados', 'ChamadoController@criarChamado')->name('cadastro.chamado');

route::get('/', function () {
    return view('welcome');
})->name('index');


//localhost:8000/usuario -- exibe a tela com as info do usuario
route::get('usuario', 'UsuarioController@index');
route::get('login-usuario', 'UsuarioController@login')->name('login-usuario');
route::Post('login-usuario', 'UsuarioController@postLogin')->name('login-submit');
route::get('register-usuario', 'UsuarioController@registerIndex')->name('register-u');
route::Post('register-usuario', 'UsuarioController@registerUsuario')->name('register-usuario');

//localhost:8000/bolsista -- exibe a tela com as info do bolsista
route::get('bolsista', 'BolsistaController@index');
route::get('login-bolsista', 'BolsistaController@login')->name('login-bolsista');
route::Post('login-bolsista', 'BolsistaController@postLogin')->name('login-submit-bolsista');
route::get('register-bolsista', 'BolsistaController@registerIndex')->name('register-b');
route::Post('register-bolsista', 'BolsistaController@registerBolsista')->name('register-bolsista');

//so entram nesses quando tiver logado
//equipamentos.store....
//equipamentos.create...
Route::resource('equipamento', 'EquipamentoController');
Route::resource('chamado', 'ChamadoController');
Route::resource('manutencao', 'ManutencaoController');
Route::resource('problema', 'ProblemaController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');