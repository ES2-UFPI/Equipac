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
    route::Post('manutencao', 'ManutencaoController@alterarStatus')->name('altera-status');
    Route::get('chamados', 'ChamadoController@index')->name('index-chamado');
    Route::post('chamados', 'ChamadoController@alterarStatus')->name('altera-status-chamado');
    Route::get('manutencao', 'ManutencaoController@index')->name('index-manutencao');
    Route::get('solucao-manutencao/{id}', 'ManutencaoController@solucaoManutencaoIndex')->name('solucao-manutencao-index');
    Route::post('solucao-manutencao/{id}', 'ManutencaoController@solucaoManutencao')->name('solucao-manutencao');
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
    route::Post('lista-problemas', 'ProblemaController@excluirProblema')->name('excluir-problema');
});

Route::prefix('supervisor')->group(function () {
    route::get('/', 'SupervisorController@index')->name('supervisor');
    route::get('login', 'Auth\SupervisorLoginController@login')->name('login-supervisor');
    route::Post('login', 'Auth\SupervisorLoginController@loginBolsista')->name('login-submit-supervisor');
    route::get('register', 'SupervisorController@registerIndex')->name('register-s');
    route::Post('register', 'SupervisorController@registerSupervisor')->name('register-supervisor');
    route::get('register-bolsista', 'SupervisorController@indexRegisterBolsista')->name('supervisor-register-bolsista-index');
    route::Post('register-bolsista', 'SupervisorController@registerBolsista')->name('supervisor-register-bolsista');
    Route::get('listar-bolsista', 'SupervisorController@indexListarBolsista')->name('listar-bolsista-index');
    route::Post('listar-bolsista', 'BolsistaController@excluirBolsista')->name('excluir-bolsista');
    Route::get('editar-bolsista/{id}', 'SupervisorController@indexEditarBolsistaInfo')->name('editar-bolsista');
    Route::post('editar-bolsista/{id}', 'SupervisorController@updateBolsista')->name('update-bolsista');
});

Route::prefix('admin')->group(function () {
    route::get('/', 'AdminController@index')->name('admin');
    route::get('login', 'Auth\AdminLoginController@login')->name('login-admin');
    route::Post('login', 'Auth\AdminLoginController@loginAdmin')->name('login-submit-admin');
    route::get('register', 'AdminController@registerIndex')->name('register-a');
    route::Post('register', 'AdminController@registerAdmin')->name('register-admin');
    route::get('listar-admin', 'AdminController@listarAdminIndex')->name('listar-admin');
    route::post('listar-admin', 'AdminController@excluirAdmin')->name('excluir-admin');
    route::get('register-admin', 'AdminController@registerAdminIndex')->name('register-admin-index');
    route::post('register-admin', 'AdminController@adminRegisterAdmin')->name('admin-register-admin');
    route::get('listar-usuario', 'AdminController@listarUsuarioIndex')->name('listar-usuario');
    route::post('listar-usuario', 'AdminController@excluirUsuario')->name('excluir-usuario');
});

Route::post('logout', 'Auth\LoginController@logout');