@extends('layouts.admin')
@section('header')
    <h1>Odaberite početni i završni datum rezervacije</h1><hr>
@endsection
@section('content')
    <div class="container">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Izbor datuma</h3>
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
            @if(session()->has('date'))
                <div class="alert alert-danger" role="alert">
                    <strong>{{session()->get('date')}}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                        &times;</button>
                </div>
          @endif
            <form role="form" action="{{url('admin/rezervacije/provjera')}}" method="POST">
                @csrf
                <div class="card-body">
                   
                    <div class="form-group">
                        <label>Datum Od</label>
                        <input type="date" name="datum1" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Datum Do</label>
                        <input type="date" name="datum2" class="form-control">
                    </div>
                    
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-outline-info">Provjeri</button>
                    <button type="reset" class="btn btn-outline-warning">Poništi</button>
                    <a style="float:right;" href="{{url('admin/rezervacije')}}" class="btn btn-outline-success">Natrag</a>
                </div>
            </form>
        </div>
    </div>
@endsection
