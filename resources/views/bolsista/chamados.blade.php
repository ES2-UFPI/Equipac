@extends('adminlte::page')
@section('content')
<!-- /.card-header -->
<!-- form start -->


<div class="row" class="container-fluid">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Problemas cadastrados</h3>

        <div class="card-tools">
          <div class="input-group input-group-sm" style="width: 150px;">
            <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

            <div class="input-group-append">
              <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
            </div>
          </div>
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body table-responsive p-0">
        <table class="table table-hover">
          <tr>
            <th>Id</th>
            <th>Descrição</th>
            <th>Data</th>
            <th></th>
          </tr>
          @foreach($problema as $e )
          <tr>
            <th>{{ $e['id']}}</th>
            <th>{{ $e['descricao']}}</th>
            <th>{{ $e['criacao']}}</th>
            <th><button type="" class="btn btn-primary">Sol. Chamado</button></th>
          </tr>
          @endforeach
        </table>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
</div><!-- /.row -->
@endsection