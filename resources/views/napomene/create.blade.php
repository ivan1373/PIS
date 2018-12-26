@extends('layouts.admin')
@section('header')
    <br><h1>Stvaranje napomene</h1><br>
@endsection
@section('content')
    <div class="container">
        <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Nova napomena</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                        &times;</button>
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>

                </div>
            @endif
              <form role="form" action="{{url('admin/napomene/nova')}}" method="POST">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label>Naslov</label>
                    <input type="text" name="naslov" class="form-control" placeholder="Unesite naslov...">
                  </div>
                  <div class="form-group">
                    <label>Sadržaj napomene</label>
                    <textarea type="password" name="tijelo" class="form-control" rows="6" cols="6"></textarea>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-outline-info">Stvori</button>
                  <button type="reset" class="btn btn-outline-warning">Poništi</button>
                  <a style="float:right;" href="{{url('admin/napomene')}}" class="btn btn-outline-success">Natrag</a>
                </div>
              </form>
        </div>
    </div>
@endsection
