<?php

namespace equipac\Http\Controllers;

use Illuminate\Http\Request;
use equipac\models\Equipamento;

class EquipamentosController extends Controller
{
	public function criarEquipamento(Request $dados, Equipamento $eqp)
	{
		//dd($dados->all());
		$tempo = array('criacao' => date('Y-m-d H:i:s'));
		$result = array_merge($dados->all(), $tempo);
		$insert = $eqp->create($result);

		if ($insert)
			return redirect()
					->route('index')
					->with('success', 'Equipamento inserida com sucesso!');

    // Redireciona de volta com uma mensagem de erro
		return redirect()
				->back()
				->with('error', 'Falha ao inserir');
	}

	public function tela() {
		return view('usuarios/manutencao');
	}
}
