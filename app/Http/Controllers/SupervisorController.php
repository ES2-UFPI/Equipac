<?php

namespace equipac\Http\Controllers;

use equipac\models\Supervisor;
use Illuminate\Http\Request;

class SupervisorController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth:supervisor', ['only' => 'index']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('supervisor');
    }

    public function registerIndex()
    {
        return view('supervisor.auth.register');
    }

    public function postLogin(Request $request)
    {
        $credenciais = ['email' => $request->get('email'),
        'password' => $request->get('password')];
        
        if (auth()->guard('supervisor')->attempt($credenciais)) {
            config(['auth.defaults.guard' => 'supervisor']);
            return redirect('home');
        } 
        else{
            return redirect('login-supervisor')
            ->withErrors(['errors' => 'nao existe']);
        }
    }

    public function registersupervisor(Request $request)
    {
        $validacao = validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required|min:3|max:150',
            'password' => 'required|min:3|max:150|unique:supervisor',
            'cpf' => 'required|max:15'
        ]);

        if($validacao->fails()){
            dd($validacao);
            return redirect('/')
            ->withErrors(['errors' => 'problemas']);
        }

        $user = new supervisor();
        $user->nome = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->cpf = $request->cpf;
        $user->nivel = 3;
        $user->save();

        return redirect()->route('login-supervisor');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('supervisor.auth.register');
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
     * @param  \equipac\models\Supervisor  $supervisor
     * @return \Illuminate\Http\Response
     */
    public function show(Supervisor $supervisor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \equipac\models\Supervisor  $supervisor
     * @return \Illuminate\Http\Response
     */
    public function edit(Supervisor $supervisor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \equipac\models\Supervisor  $supervisor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Supervisor $supervisor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \equipac\models\Supervisor  $supervisor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supervisor $supervisor)
    {
        //
    }
}