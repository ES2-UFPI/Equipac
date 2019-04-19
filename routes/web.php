<?php

Route::get('/', function () {
    return view('painel');
});
//Route::get('/chamados', 'ChamadoController@tela');
//Route::get('/equipamento', 'EquipamentoController@create');

//route::post('cadastroEquipamento', 'EquipamentosController@store')->name('cadastro');

//route::post('cadastroChamados', 'ChamadoController@criarChamado')->name('cadastro.chamado');

route::get('/', function () {
    return view('painel');
})->name('index');

//equipamentos.store....
//equipamentos.create...
Route::resource('equipamento', 'EquipamentoController');
Route::resource('chamado', 'ChamadoController');
Route::resource('manutencao', 'ManutencaoController');