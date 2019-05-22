<?php

namespace equipac\Http\Controllers;

use equipac\models\Manutencao;
use equipac\models\Equipamento;
use equipac\models\Usuario;
use equipac\models\Status_manutencao;
use Illuminate\Http\Request;

class ManutencaoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:bolsista', ['only' => 'index']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Manutencao $ma, Equipamento $equip)
    {
        //$e = $equip::all();
        //$e = $ma::find($manutencao[0]->id)->equipamento;
        //dd($e[0]::find()->usuario);
        //dd($manutencao[0]::find($manutencao[0]->id)->equipamento[0]::find(0)->usuario[0]->id);
        $manutencao = $ma::all();
        // if(!$manutencao->isEmpty()){
        //     $e = Manutencao::find($manutencao[0]->id)->equipamento;
        //     $a = Equipamento::find($e[0]->id)->usuario;
        // }
        
        //dd($a->id);
        return view('bolsista.manutencao', compact('manutencao'));
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
    public function store(Request $request, Equipamento $eqp, Manutencao $manut)
    {
        //dd($eqp::find($request->get('id'))->usuario->id);
        $eqpp = $eqp::find($request->get('id'));
        $ext = array('dataAtribuida' => date('Y-m-d H:i:s'));
        $ext2 = array('status_id' => '1');
        $result = array_merge($ext2, $ext);
        $insert = $manut->create($result);
        if ($insert) {
            $eqpp->manutencao()->attach($insert, ['equipamento_usuario_id' => $eqp::find($request->get('id'))->usuario->id]);
            return redirect()
            ->route('equipamento.index')
            ->with('success', 'Equipamento inserida com sucesso!');
        }
        return redirect()
        ->back()
        ->with('error', 'Falha ao inserir');
    }

    public function AlterarStatus(Request $request, Status_manutencao $status, Manutencao $ma)
    {
        $manut = $ma::find($request->id);
        $sts = $status::find($request->status);
        $manut->status()->associate($sts);
        if ($manut->save()) {
            return redirect()
            ->route('index-manutencao')
            ->with('success', 'Manutenção Cadastrada com sucesso!');
        }
        return redirect()
        ->back()
        ->with('error', 'Falha ao Cadastrar');
    }

    /**
     * Display the specified resource.
     *
     * @param  \equipac\models\Manutencao  $manutencao
     * @return \Illuminate\Http\Response
     */
    public function show(Manutencao $manutencao)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \equipac\models\Manutencao  $manutencao
     * @return \Illuminate\Http\Response
     */
    public function edit(Manutencao $manutencao)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \equipac\models\Manutencao  $manutencao
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Manutencao $manutencao)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \equipac\models\Manutencao  $manutencao
     * @return \Illuminate\Http\Response
     */
    public function destroy(Manutencao $manutencao)
    {
        //
    }
    
    public function atribuirChamado()
    {
    }
}
