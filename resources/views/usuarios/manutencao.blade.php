@extends('adminlte::page')
@section('content')
 <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="POST" action="{{ route('categories.store') }}">
                  <div class="card-body">
                    <!-- textarea -->
                    <div class="form-group">
                      <label>Patrimonio</label>
                      <input class="form-control" id="exampleInputEmail1" placeholder="Patrimonio">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Modelo</label>
                      <input class="form-control" id="exampleInputPassword1" placeholder="Modelo">
                    </div>
                    
                        <div class="form-group">
                            <label>Problema</label>
                            <textarea class="form-control" rows="3" placeholder="Enter ..."></textarea>
                        </div>
                    <div class="form-check">
                      <input type="checkbox" class="form-check-input" id="exampleCheck1">
                      <label class="form-check-label" for="exampleCheck1">Check me out</label>
                    </div>
                  </div>
                  <!-- /.card-body -->
                  
                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                </form>
              </div>
      
@endsection