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
<!-- /.card-header -->
<!-- form start -->
<div class="row" class="container-fluid">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Equipamento cadastrados</h3>

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
            <th>Id</th>
            <th>nome</th>
          </tr>
          @foreach($manutencao as $index => $ma )
          <?php $e = $ma::find($manutencao[$index]->id)->equipamento; ?>
          @foreach($e as $equipamento)
          <?php $a = $equip::find($equipamento->id)->usuario;?>
          <tr>
            <th>{{ $ma['id']}}</th>
            <th>{{$a->id}}</th>
            <td>{{$a->nome}}</td>
         </tr>
         @endforeach
         @endforeach
       </table>
     </div>
     <!-- /.card-body -->
   </div>
   <!-- /.card -->
 </div>
 <!-- /.row -->

 @endsection