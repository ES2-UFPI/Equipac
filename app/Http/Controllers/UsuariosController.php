<?php

namespace equipac\Http\Controllers;

use Illuminate\Http\Request;

class UsuariosController extends Controller
{
    public function create()
    {
        return view('usuarios.manutencao');
        // => resources/views/admin/categories/create.blade.php
    }
}
