@extends('adminlte::page')
@section('content')
<h1>{{auth()->user()->nome}}</h1>
@endsection