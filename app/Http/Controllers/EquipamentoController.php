<?php

namespace equipac\Http\Controllers;

use Illuminate\Http\Request;
use equipac\models\Equipamento;

class EquipamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Equipamento $eqp)
    {
        $equipamento = $eqp::all();
        return view('usuarios.equipamento' , compact('equipamento'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('usuarios/equipamento');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Equipamento $eqp)
    {
        //dd($dados->all());
        $ext = array('criacao' => date('Y-m-d H:i:s'),
                     'usuario_id' => auth()->user()->id
                    );
        $result = array_merge($request->all(), $ext);
        $insert = $eqp->create($result);

        if ($insert)
            return redirect()
        ->route('equipamento.index')
        ->with('success', 'Equipamento inserida com sucesso!');

    // Redireciona de volta com uma mensagem de erro
        return redirect()
        ->back()
        ->with('error', 'Falha ao inserir');
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
}
