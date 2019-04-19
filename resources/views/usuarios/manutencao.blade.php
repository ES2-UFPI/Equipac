@extends('adminlte::page')
@section('content')
 <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="POST" action="{{ route('cadastro') }}">
                {!! csrf_field() !!}
                  <div class="card-body">
                    <!-- textarea -->
                    <div class="form-group">
                      <label>Patrimonio</label>
                      <input type="number" class="form-control" id="patrimonio" name="patrimonio" placeholder="Patrimonio">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Modelo</label>
                      <input type="text" class="form-control" id="modelo" name="modelo" placeholder="Modelo">
                    </div>
                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Adicionar</button>
                  </div>
                </form>
              </div>
      
@endsection