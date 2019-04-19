<?php

namespace equipac\Http\Controllers;

use Illuminate\Http\Request;
use equipac\models\Chamados;

class ChamadosController extends Controller
{
    public function tela() {
		return view('usuarios/chamados');
	}

	public function criarChamado(Request $dados, Chamados $cham)
	{
		//dd($dados->all());
		$tempo = array('criacao' => date('Y-m-d H:i:s'));
		$result = array_merge($dados->all(), $tempo);
		$insert = $cham->create($result);

		if ($insert)
			return redirect()
					->route('index')
					->with('success', 'Chamado criado com sucesso!');

    // Redireciona de volta com uma mensagem de erro
		return redirect()
				->back()
				->with('error', 'Falha ao Criar');
	}
}
