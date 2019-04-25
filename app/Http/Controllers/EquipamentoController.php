<?php

namespace equipac\Http\Controllers;

use Illuminate\Http\Request;
use equipac\models\Equipamento;
use equipac\models\Manutencao;
use equipac\models\Usuario;

use Auth;

class EquipamentoController extends Controller
{
     public function __construct()
    {
        //auth()->setDefaultDriver('usuario');


        $this->middleware('auth:usuario',['only' => 'index', 'create', 'store', 'update', 'destroy']);

    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Equipamento $eqp, Usuario $usuario)
    {
        //dd(Auth::guard()->user()->id);
        $equipamento = $usuario::find(auth()->user()->id)->equipamento;

        return view('usuarios.equipamento' , compact('equipamento'));
    }

     public function indexLista(Equipamento $eqp, Usuario $usuario)
    {
        dd(Auth::guard()->user()->id);
        //$equipamento = $usuario::find(auth()->user()->id)->equipamento;

        return view('usuarios.lista-equipamento' , compact('equipamento'));
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
                     'usuario_id' => auth()->guard('usuario')->user()->id
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

    public function manutencao(Request $request, Equipamento $eqp, Manutencao $manut)
    {
        //dd($eqp::find($request->get('id'))->usuario->id);
        $eqpp = $eqp::find($request->get('id'));
        $ext = array('dataAtribuida' => date('Y-m-d H:i:s'));
        $ext2 = array('status' => 'Atribuida');  
        $result = array_merge($ext2, $ext);
        $insert = $manut->create($result);
        if ($insert){
            $eqpp->manutencao()->attach($insert, ['equipamento_usuario_id' => $eqp::find($request->get('id'))->usuario->id]);
            return redirect()
            ->route('lista-equipamento.index')
            ->with('success', 'Manutenção Cadastrada com sucesso!');
        }
        return redirect()
        ->back()
        ->with('error', 'Falha ao Cadastrar');
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
