@extends('adminlte::page')
@section('title', 'Equipac Bolsista')
@section('content')
<h1>{{auth()->guard('bolsista')->user()->nome}}</h1>
@endsection