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

<div class="container-fluid">
  <div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <div class="breadcome-list single-page-breadcome">
        <div class="row">
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
            <div class="breadcome-heading">
              <form role="search" class="sr-input-func">
                <input type="text" placeholder="Search..." class="search-int form-control">
                <a href="#"><i class="fa fa-search"></i></a>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
       <div class="card-body table-responsive p-0">
        <table class="table table-hover">
          <tr>
            <th>Id</th>
            <th>Nome</th>
            <th>E-mail</th>
            <th>Opções</th>      
          </tr>
          @foreach($adm as $index => $e )
          <tr>
            <th>{{ $e['id']}}</th>
            <th>{{ $e['nome']}}</th>
            <th>{{ $e['email']}}</th>
            <th>
              <form method="post" action="{{route('excluir-supervisor')}}">
                @csrf
                <input type="hidden" name="id" value="{{$e['id']}}">
                <button type="imput" class="btn btn-danger">Excluir</button></th>
              </form>
            </th>
            <th>
              <a href="{{route('editar-supervisor', $e['id'])}}">
                <button type="imput" class="btn btn-primary">Editar</button>
              </a>
            </th>
          </th>
        </tr>
        @endforeach
      </table>
    </div>
  </div>
</div>
</div>
</div>
@endsection