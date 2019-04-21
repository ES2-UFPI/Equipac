<?php

namespace equipac\Http\Controllers;

use equipac\models\Usuario;
use Illuminate\Http\Request;
use Auth;
use Validator;

class UsuarioController extends Controller
{

    public function __construct()
    {
        auth()->setDefaultDriver('usuario');
    }

    public function index()
    {
        return view('usuario');
    }

    public function registerIndex()
    {
        return view('usuarios.auth.register-usuario');
    }

    public function login()
    {
        return view('usuarios.auth.login-usuario');
    }

    public function postLogin(Request $request)
    {
        $credenciais = ['email' => $request->get('email'),
        'password' => $request->get('password')
    ];
    config(['auth.defaults.guard' => 'usuario']);
        //dd(auth()->guard('usuario')->attempt($credenciais));
    if (auth()->guard('usuario')->attempt($credenciais)) {
            //dd(auth()->guard('usuario')->user());
        return redirect('usuario');
    } 
    else{
        return redirect('login-usuario')
        ->withErrors(['errors' => 'nao existe']);
    }

}

public function registerUsuario(Request $request)
{
    $validacao = validator::make($request->all(),[
        'name' => 'required',
        'email' => 'required|min:3|max:150',
        'password' => 'required|min:3|max:150|unique:Usuario',
        'cpf' => 'required|max:15'
    ]);

    if($validacao->fails()){
        dd($validacao);
        return redirect('/')
        ->withErrors(['errors' => 'Problema']);
    }

    $user = new Usuario();
    $user->nome = $request->name;
    $user->email = $request->email;
    $user->password = bcrypt($request->password);
    $user->cpf = $request->cpf;
    $user->nivel = 3;
    $user->save();


    return redirect('login-usuario');

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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \equipac\models\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function show(Usuario $usuario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \equipac\models\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function edit(Usuario $usuario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \equipac\models\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Usuario $usuario)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \equipac\models\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function destroy(Usuario $usuario)
    {
        //
    }
}
