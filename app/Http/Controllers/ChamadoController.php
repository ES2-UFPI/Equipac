<?php

namespace equipac\Http\Controllers;

use Illuminate\Http\Request;
use equipac\models\problema;
use equipac\models\Chamados;
use equipac\models\Status_chamado;

class ChamadoController extends Controller
{
    public function __construct()
    {
        //auth()->setDefaultDriver('usuario');


        $this->middleware('auth:bolsista', ['only' => 'index', 'create', 'store', 'update', 'destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Chamados $prob)
    {
        $chamado = $prob::all();
        return view('bolsista.chamados', compact('chamado'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Chamados $cham)
    {
        //dd($dados->all());
        $ext = array('criacao' => date('Y-m-d H:i:s'),
                    'usuario_id' => auth()->user()->id);
        $result = array_merge($request->all(), $ext);
        $insert = $cham->create($result);

        if ($insert) {
            return redirect()
                    ->route('index')
                    ->with('success', 'Chamado criado com sucesso!');
        }

    // Redireciona de volta com uma mensagem de erro
        return redirect()
                ->back()
                ->with('error', 'Falha ao Criar');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function alterarStatus(Request $request, Status_chamado $status, Chamados $cham)
    {
        $chamado = $cham::find($request->id);
        $sts = $status::find($request->status);
        $chamado->status()->associate($sts);
        if ($chamado->save()) {
            return redirect()
            ->route('index-chamado')
            ->with('success', 'Chamado alterado com sucesso!');
        }
        return redirect()
        ->back()
        ->with('error', 'Falha ao Cadastrar');
    }
}
