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

//so entram nesses quando tiver logado
//equipamentos.store....
//equipamentos.create...
Route::resource('equipamento', 'EquipamentoController');
Route::resource('chamado', 'ChamadoController');
Route::resource('manutencao', 'ManutencaoController');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
