@extends('adminlte::page')
@section('content')
<h1>{{auth()->guard('usuario')->user()->nome}}</h1>
@endsection