@extends('adminlte::page')
@section('content')
 <!-- /.card-header -->
              <!-- form start -->
              <form method="POST" role="form" action="{{route('chamado.store')}}">
                {!! csrf_field() !!}
                  <div class="card-body">
                    <!-- textarea -->
                    <div class="form-group">
                        <label>Informe o problema</label>
                        <textarea name="descricao" id="descricacao" class="form-control" rows="3" placeholder="Enter ..."></textarea>
                    </div>
                  <!-- /.card-body -->
  
                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                </form>
              </div>
      
@endsection