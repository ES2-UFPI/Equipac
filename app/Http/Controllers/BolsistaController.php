<?php

namespace equipac\Http\Controllers;

use equipac\models\Bolsista;
use Illuminate\Http\Request;
use Auth;
use Validator;

class BolsistaController extends Controller
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

    public function index()
    {
        return view('bolsista');
    }

    public function registerIndex()
    {
        return view('bolsista.auth.register');
    }

    public function login()
    {
        return view('bolsista.auth.login-bolsista');
    }

    public function postLogin(Request $request)
    {
        $credenciais = ['email' => $request->get('email'),
        'password' => $request->get('password')];
        
        if (auth()->guard('bolsista')->attempt($credenciais)) {
            config(['auth.defaults.guard' => 'bolsista']);
            return redirect('home');
        } 
        else{
            return redirect('login-bolsista')
            ->withErrors(['errors' => 'nao existe']);
        }
    }

    public function registerbolsista(Request $request)
    {
        $validacao = validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required|min:3|max:150',
            'password' => 'required|min:3|max:150|unique:bolsista',
            'cpf' => 'required|max:15'
        ]);

        if($validacao->fails()){
            dd($validacao);
            return redirect('/')
            ->withErrors(['errors' => 'problemas']);
        }

        $user = new Bolsista();
        $user->nome = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->cpf = $request->cpf;
        $user->nivel = 2;
        $user->save();

        return redirect()->route('login-bolsista');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('bolsista.auth.register');
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
     * @param  \equipac\models\Bolsista  $bolsista
     * @return \Illuminate\Http\Response
     */
    public function show(Bolsista $bolsista)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \equipac\models\Bolsista  $bolsista
     * @return \Illuminate\Http\Response
     */
    public function edit(Bolsista $bolsista)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \equipac\models\Bolsista  $bolsista
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bolsista $bolsista)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \equipac\models\Bolsista  $bolsista
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bolsista $bolsista)
    {
        //
    }
}
