<?php

Route::get('/', function () {
    return view('painel');
});
Route::get('/chamados', function () {
    return view('usuarios/chamados');
});
Route::get('/manutencao', function () {
    return view('usuarios/manutencao');
});
