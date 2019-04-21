@extends('adminlte::page')
@section('content')
<h1>{{auth()->guard('bolsista')->user()->nome}}</h1>
@endsection