<?php

namespace equipac\Http\Controllers;

use equipac\models\problema;
use Illuminate\Http\Request;

class ProblemaController extends Controller
{
    public function __construct()
    {
        auth()->setDefaultDriver('usuario');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Problema $prob)
    {
        $problema = $prob::all();
        return view('usuarios.problemas' , compact('problema'));
    }

    public function indexLista(Problema $prob)
    {
        $problema = $prob::all();
        return view('usuarios.lista-problemas' , compact('problema'));
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
    public function store(Request $request, Problema $cham)
    {
       $ext = array('criacao' => date('Y-m-d H:i:s'),
        'usuario_id' => auth()->user()->id);
       $result = array_merge($request->all(), $ext);
       $insert = $cham->create($result);

       if ($insert)
        return redirect()
    ->route('problemas.index')
    ->with('success', 'Chamado criado com sucesso!');

    // Redireciona de volta com uma mensagem de erro
    return redirect()
    ->back()
    ->with('error', 'Falha ao Criar');
}

public function manutencao(Request $request, Chamados $cham)
{
        //dd($dados->all());
/*
    $ext = array('criacao' => date('Y-m-d H:i:s'),
        'usuario_id' => auth()->user()->id);
    $result = array_merge($request->all(), $ext);
    $insert = $cham->create($result);

    if ($insert)
        return redirect()
    ->route('index')
    ->with('success', 'Chamado criado com sucesso!');

    // Redireciona de volta com uma mensagem de erro
    return redirect()
    ->back()
    ->with('error', 'Falha ao Criar');

*/    
}
    /**
     * Display the specified resource.
     *
     * @param  \equipac\models\problema  $problema
     * @return \Illuminate\Http\Response
     */
    public function show(problema $problema)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \equipac\models\problema  $problema
     * @return \Illuminate\Http\Response
     */
    public function edit(problema $problema)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \equipac\models\problema  $problema
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, problema $problema)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \equipac\models\problema  $problema
     * @return \Illuminate\Http\Response
     */
    public function destroy(problema $problema)
    {
        //
    }
}
