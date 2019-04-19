<?php

Route::get('/', function () {
    return view('painel');
});
Route::get('/chamados', 'ChamadosController@tela');
Route::get('/manutencao', 'EquipamentosController@tela');

route::post('cadastroEquipamento', 'EquipamentosController@criarEquipamento')->name('cadastro');

route::post('cadastroChamados', 'ChamadosController@criarChamado')->name('cadastro.chamado');

route::get('/', function () {
    return view('painel');
})->name('index');