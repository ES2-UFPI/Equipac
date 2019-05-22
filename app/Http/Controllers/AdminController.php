<?php

namespace equipac\Http\Controllers;

use equipac\models\Admin;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Schema;
use Auth;
use Validator;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin')->except(['registerAdmin', 'registerIndex']);
    }

    public function index()
    {
        return view('admin');
    }

    public function registerIndex()
    {
        return view('admin.auth.register');
    }

    public function registerAdminIndex()
    {
        return view('admin.register-admin');
    }

    public function postLogin(Request $request)
    {
        $credenciais = ['email' => $request->get('email'),
        'password' => $request->get('password')];
        
        if (auth()->guard('admin')->attempt($credenciais)) {
            config(['auth.defaults.guard' => 'admin']);
            return redirect('home');
        } else {
            return redirect('login-admin')
            ->withErrors(['errors' => 'nao existe']);
        }
    }

    public function registerAdmin(Request $request)
    {
        $validacao = validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|min:3|max:150',
            'password' => 'required|min:3|max:150|unique:admin'
        ]);

        if ($validacao->fails()) {
            dd($validacao);
            return redirect('/')
            ->withErrors(['errors' => 'problemas']);
        }

        $user = new admin();
        $user->nome = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->nivel = 0;
        $user->save();

        return redirect()->route('login-admin');
    }

    public function adminRegisterAdmin(Request $request)
    {
        $validacao = validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|min:3|max:150',
            'password' => 'required|min:3|max:150|unique:admin'
        ]);

        if ($validacao->fails()) {
            dd($validacao);
            return redirect('/')
            ->withErrors(['errors' => 'problemas']);
        }

        $user = new admin();
        $user->nome = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->nivel = 0;
        $user->save();

        return redirect()->route('listar-admin')->with('success', 'Admin cadastrado com sucesso!');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
     * @param  \equipac\models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \equipac\models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $admin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \equipac\models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Admin $admin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \equipac\models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {
        //
    }

    public function listarAdminIndex(Admin $admin)
    {
        $adm = $admin::all();
        return view('admin.listar-admin', compact('adm'));
    }
}




app/Http/Controllers/Auth/RegisterController.php


<?php

namespace equipac\Http\Controllers\Auth;

use equipac\User;
use equipac\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
        $this->middleware('guest:usuario');
        $this->middleware('guest:bolsista');
        $this->middleware('guest:supervisor');
        $this->middleware('guest:admin');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \equipac\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}




app/Http/Controllers/SupervisorController.php


<?php

namespace equipac\Http\Controllers;

use equipac\models\Supervisor;
use equipac\models\Bolsista;
use Illuminate\Http\Request;
use Auth;
use Validator;

class SupervisorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:supervisor')->except(['registerSupervisor', 'registerIndex']);
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

    public function indexListarBolsista(Bolsista $bolsista)
    {
        $bol = $bolsista::all();
        return view('supervisor.listar-bolsista', compact('bol'));
    }

    public function indexEditarBolsista()
    {
        $bol = null;
        return view('supervisor.editar-bolsista', compact('bol'));
    }

    public function postLogin(Request $request)
    {
        $credenciais = ['email' => $request->get('email'),
        'password' => $request->get('password')];
        
        if (auth()->guard('supervisor')->attempt($credenciais)) {
            config(['auth.defaults.guard' => 'supervisor']);
            return redirect('home');
        } else {
            return redirect('login-supervisor')
            ->withErrors(['errors' => 'nao existe']);
        }
    }

    public function registerSupervisor(Request $request)
    {
        $validacao = validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|min:3|max:150',
            'password' => 'required|min:3|max:150|unique:supervisor',
            'cpf' => 'required|max:15'
        ]);

        if ($validacao->fails()) {
            dd($validacao);
            return redirect('/')
            ->withErrors(['errors' => 'problemas']);
        }

        $user = new supervisor();
        $user->nome = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->cpf = $request->cpf;
        $user->nivel = 1;
        $user->save();

        return redirect()->route('login-supervisor');
    }

    public function registerBolsista(Request $request)
    {
        $validacao = validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|min:3|max:150',
            'password' => 'required|min:3|max:150|unique:bolsista',
            'cpf' => 'required|max:15'
        ]);

        if ($validacao->fails()) {
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

        return redirect()->route('supervisor-register-bolsista')->with('success', 'Bolsista cadastrado com sucesso!');
    }

    public function indexRegisterBolsista()
    {
        return view('supervisor.register-bolsista');
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

    public function indexEditarBolsistaInfo(int $id, Bolsista $bolsista)
    {
        $bol = $bolsista::find($id);
        return view('supervisor.editar-bolsista', compact('bol'));
    }

    public function updateBolsista(int $id, Request $request, Bolsista $bolsista)
    {
        $bol = $bolsista::find($id);
        $bol['nome'] = $request->get('nome');
        $bol['email'] = $request->get('email');
        if ($bol->save()) {
            return  redirect()->route('listar-bolsista-index')->with('success', 'Informações do Bolsista atualizadas com sucesso!');
        } else {
            return  redirect()->route('listar-bolsista-index')->with('error', 'Informações do Bolsista não foram atualizadas!');
        }
    }
}



config/adminlte.php


<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Title
    |--------------------------------------------------------------------------
    |
    | The default title of your admin panel, this goes into the title tag
    | of your page. You can override it per page with the title section.
    | You can optionally also specify a title prefix and/or postfix.
    |
    */

    'title' => 'Equipac Usuário',

    'title_prefix' => '',

    'title_postfix' => '',

    /*
    |--------------------------------------------------------------------------
    | Logo
    |--------------------------------------------------------------------------
    |
    | This logo is displayed at the upper left corner of your admin panel.
    | You can use basic HTML here if you want. The logo has also a mini
    | variant, used for the mini side bar. Make it 3 letters or so
    |
    */

    'logo' => '<b>Equipac</b>',

    'logo_mini' => '<b>E</b>PC',

    /*
    |--------------------------------------------------------------------------
    | Skin Color
    |--------------------------------------------------------------------------
    |
    | Choose a skin color for your admin panel. The available skin colors:
    | blue, black, purple, yellow, red, and green. Each skin also has a
    | ligth variant: blue-light, purple-light, purple-light, etc.
    |
    */

    'skin' => 'green',

    /*
    |--------------------------------------------------------------------------
    | Layout
    |--------------------------------------------------------------------------
    |
    | Choose a layout for your admin panel. The available layout options:
    | null, 'boxed', 'fixed', 'top-nav'. null is the default, top-nav
    | removes the sidebar and places your menu in the top navbar
    |
    */

    'layout' => null,

    /*
    |--------------------------------------------------------------------------
    | Collapse Sidebar
    |--------------------------------------------------------------------------
    |
    | Here we choose and option to be able to start with a collapsed side
    | bar. To adjust your sidebar layout simply set this  either true
    | this is compatible with layouts except top-nav layout option
    |
    */

    'collapse_sidebar' => false,

    /*
    |--------------------------------------------------------------------------
    | URLs
    |--------------------------------------------------------------------------
    |
    | Register here your dashboard, logout, login and register URLs. The
    | logout URL automatically sends a POST request in Laravel 5.3 or higher.
    | You can set the request to a GET or POST with logout_method.
    | Set register_url to null if you don't want a register link.
    |
    */

    'dashboard_url' => 'home',

    'logout_url' => 'logout',

    'logout_method' => null,

    'login_url' => 'login',

    'chamados_url' => 'chamado',


    /*
    |--------------------------------------------------------------------------
    | Menu Items
    |--------------------------------------------------------------------------
    |
    | Specify your menu items to display in the left sidebar. Each menu item
    | should have a text and and a URL. You can also specify an icon from
    | Font Awesome. A string instead of an array represents a header in sidebar
    | layout. The 'can' is a filter on Laravel's built in Gate functionality.
    |
    */

    'menu' => [
        'Menu Solicitações',
        [
            'text' => 'Solicitações',
            'url'  => 'usuario',
            'can'  => '',
        ],
        [
            'text'        => 'Sol. de Manutenção',
            'url'         => 'bolsista/manutencao',
            'icon'        => 'wrench',
            //'label'       => 5,
            //'label_color' => 'success',
            'can'         => 'bolsista',
        ],
        [
            'text'        => 'Sol. de chamados',
            'url'         => 'bolsista/chamados',
            'icon'        => 'comments',
            //'label'       => 10,
            //'label_color' => 'success',
            'can'         => 'bolsista',
        ],
        [
            'text'        => 'Equipamentos',
            'url'         => 'usuario/equipamento',
            'icon'        => 'wrench',
            'can'         => 'usuario',
        ],
        [
            'text'        => 'Problemas',
            'url'         => 'usuario/problemas',
            'icon'        => 'comments',
            'can'         => 'usuario'
        ],
        [
            'text'        => 'Lista Equipamentos',
            'url'         => 'usuario/lista-equipamento',
            'icon'        => 'comments',
            //'label'       => 2,
            //'label_color' => 'success',
            'can'         => 'usuario'
        ],
        [
            'text'        => 'Listar Problemas',
            'url'         => 'usuario/lista-problemas',
            'icon'        => 'comments',
            //'label'       => 2,
            //'label_color' => 'success',
            'can'         => 'usuario'
        ],
        [
            'text'        => 'Cadastrar Bolsista',
            'url'         => 'supervisor/register-bolsista',
            'icon'        => 'comments',
            //'label_color' => 'success',
            'can'         => 'supervisor'
        ],
        [
            'text'        => 'Listar Bolsistas',
            'url'         => 'supervisor/listar-bolsista',
            'icon'        => 'list',
            //'label_color' => 'success',
            'can'         => 'supervisor'
        ],
        [
            'text'        => 'Cadastrar Admin',
            'url'         => 'admin/register-admin',
            'icon'        => 'list',
            //'label_color' => 'success',
            'can'         => 'admin'
        ],
        [
            'text'        => 'Lista Admin',
            'url'         => 'admin/listar-admin',
            'icon'        => 'list',
            //'label_color' => 'success',
            'can'         => 'admin'
        ],
    ],
    /*    'ACCOUNT SETTINGS',
        [
            'text' => 'Profile',
            'url'  => 'admin/settings',
            'icon' => 'user',
        ],
        [
            'text' => 'Change Password',
            'url'  => 'admin/settings',
            'icon' => 'lock',
        ],
        [
            'text'    => 'Multilevel',
            'icon'    => 'share',
            'submenu' => [
                [
                    'text' => 'Level One',
                    'url'  => '#',
                ],
                [
                    'text'    => 'Level One',
                    'url'     => '#',
                    'submenu' => [
                        [
                            'text' => 'Level Two',
                            'url'  => '#',
                        ],
                        [
                            'text'    => 'Level Two',
                            'url'     => '#',
                            'submenu' => [
                                [
                                    'text' => 'Level Three',
                                    'url'  => '#',
                                ],
                                [
                                    'text' => 'Level Three',
                                    'url'  => '#',
                                ],
                            ],
                        ],
                    ],
                ],
                [
                    'text' => 'Level One',
                    'url'  => '#',
                ],
            ],
        ],
        'LABELS',
        [
            'text'       => 'Important',
            'icon_color' => 'red',
        ],
        [
            'text'       => 'Warning',
            'icon_color' => 'yellow',
        ],
        [
            'text'       => 'Information',
            'icon_color' => 'aqua',
        ],
    ],
*/
    /*
    |--------------------------------------------------------------------------
    | Menu Filters
    |--------------------------------------------------------------------------
    |
    | Choose what filters you want to include for rendering the menu.
    | You can add your own filters to this array after you've created them.
    | You can comment out the GateFilter if you don't want to use Laravel's
    | built in Gate functionality
    |
    */

    'filters' => [
        JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SubmenuFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Plugins Initialization
    |--------------------------------------------------------------------------
    |
    | Choose which JavaScript plugins should be included. At this moment,
    | only DataTables is supported as a plugin. Set the value to true
    | to include the JavaScript file from a CDN via a script tag.
    |
    */

    'plugins' => [
        'datatables' => true,
        'select2'    => true,
        'chartjs'    => true,
    ],
];



resources/views/admin/register-admin.blade.php


@extends('adminlte::page')
@section('content')

@if(session('success'))
<div class="alert alert-success">
  {{ session('success') }}
</div>
@endif

@if(session('error'))
<div class="alert alert-danger">
  {{ session('error') }}
</div>
@endif

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">

        <div class="container">
          <form method="POST" action="{{ route('admin-register-admin') }}">
            @csrf
            @if ($errors->has('errors'))
            <span class="invalid-feedback" role="alert">
              <strong>{{ $errors->first('errors') }}</strong>
            </span>
            @endif
            <div class="form-group row">
              <label for="name" class="col-md-2 col-form-label text-md-right">{{ __('Name') }}</label>

              <div class="col-md-6">
                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
              </div>
            </div>

            <div class="form-group row">
              <label for="email" class="col-md-2 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

              <div class="col-md-6">
                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autocomplete="email">


              </div>
            </div>

            <div class="form-group row">
              <label for="password" class="col-md-2 col-form-label text-md-right">{{ __('Password') }}</label>

              <div class="col-md-6">
                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required autocomplete="new-password">


              </div>
            </div>

            <div class="card">
            <div class="form-group row mb-0">
              <div class="col-md-6 offset-md-2">
                <button type="submit" class="btn btn-primary">
                  {{ __('Register') }}
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection


routes/web.php


<?php

route::get('/', function () {
    return view('welcome');
})->name('index');


Auth::routes();

Route::get('home', 'HomeController@index')->name('home');

Route::prefix('bolsista')->group(function () {
    route::get('/', 'BolsistaController@index')->name('bolsista');
    route::get('login', 'Auth\BolsistaLoginController@login')->name('login-bolsista');
    route::Post('login', 'Auth\BolsistaLoginController@loginBolsista')->name('login-submit-bolsista');
    route::get('register', 'BolsistaController@registerIndex')->name('register-b');
    route::Post('register', 'BolsistaController@registerBolsista')->name('register-bolsista');
    route::Post('manutencao', 'ManutencaoController@AlterarStatus')->name('altera-status');
    Route::resource('chamados', 'ChamadoController');
    Route::get('manutencao', 'ManutencaoController@index')->name('index-manutencao');
});

Route::prefix('usuario')->group(function () {
    route::get('/', 'UsuarioController@index')->name('usuario');
    route::get('login', 'Auth\UsuarioLoginController@login')->name('login-usuario');
    route::Post('login', 'Auth\UsuarioLoginController@loginUsuario')->name('login-submit');
    route::get('register', 'UsuarioController@registerIndex')->name('register-u');
    route::Post('register', 'UsuarioController@registerUsuario')->name('register-usuario');
    Route::resource('problemas', 'ProblemaController');
    Route::resource('equipamento', 'EquipamentoController');
    Route::get('lista-equipamento', 'ListarEquipamentoController@index')->name('lista-equipamento-index');
    route::Post('lista-equipamento', 'EquipamentoController@manutencao')->name('equipamento-manutencao');
    route::get('lista-problemas', 'ProblemaController@indexLista')->name('lista-problemas');
    route::Post('lista-problemas', 'ProblemaController@chamado')->name('problema-chamado');
});

Route::prefix('supervisor')->group(function () {
    route::get('/', 'SupervisorController@index')->name('supervisor');
    route::get('login', 'Auth\SupervisorLoginController@login')->name('login-supervisor');
    route::Post('login', 'Auth\SupervisorLoginController@loginBolsista')->name('login-submit-supervisor');
    route::get('register', 'SupervisorController@registerIndex')->name('register-s');
    route::Post('register', 'SupervisorController@registerSupervisor')->name('register-supervisor');
    route::get('register-bolsista', 'SupervisorController@indexRegisterBolsista')->name('supervisor-register-bolsista-index');
    route::Post('register-bolsista', 'SupervisorController@registerBolsista')->name('supervisor-register-bolsista');
    Route::get('listar-bolsista', 'SupervisorController@indexListarBolsista')->name('listar-bolsista-index');
    route::Post('listar-bolsista', 'BolsistaController@excluirBolsista')->name('excluir-bolsista');
    Route::get('editar-bolsista/{id}', 'SupervisorController@indexEditarBolsistaInfo')->name('editar-bolsista');
    Route::post('editar-bolsista/{id}', 'SupervisorController@updateBolsista')->name('update-bolsista');
});

Route::prefix('admin')->group(function () {
    route::get('/', 'AdminController@index')->name('admin');
    route::get('login', 'Auth\AdminLoginController@login')->name('login-admin');
    route::Post('login', 'Auth\AdminLoginController@loginAdmin')->name('login-submit-admin');
    route::get('register', 'AdminController@registerIndex')->name('register-a');
    route::Post('register', 'AdminController@registerAdmin')->name('register-admin');
    route::get('listar-admin', 'AdminController@listarAdminIndex')->name('listar-admin');
    route::get('register-admin', 'AdminController@registerAdminIndex')->name('register-admin-index');
    route::post('register-admin', 'AdminController@adminRegisterAdmin')->name('admin-register-admin');
});

Route::post('logout', 'Auth\LoginController@logout');