@extends('layouts.admin')
@section('header')
    <h1>Izmjena osobnih podataka</h1><hr>
@endsection
@section('content')
    <div class="container">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Izmijenite podatke</h3>
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
            <form role="form" action="{{url('admin/izmjena')}}" method="POST" enctype="multipart/form-data">
                @csrf
                {{method_field('PUT')}}
                <div class="card-body">
                    <div class="form-group">
                        <label>Ime korisnika</label>
                        <input type="text" name="name" class="form-control" value="{{Auth::user()->name}}">
                    </div>
                    <div class="form-group">
                        <label>E-Mail adresa</label>
                        <input type="email" name="email" class="form-control" value="{{Auth::user()->email}}">
                    </div>
                    <div class="form-group">
                        <label>Lozinka</label>
                        <input type="password" name="lozinka" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Potvrdite lozinku</label>
                        <input type="password" name="lozinkaP" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Odaberite sliku</label><br>
                        <input type="file" name="slika">
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-outline-info">Potvrdi</button>
                    <button type="reset" class="btn btn-outline-warning">Poništi</button>
                    <a style="float:right;" href="{{url('admin')}}" class="btn btn-outline-success">Natrag</a>
                </div>
            </form>
        </div>
    </div>
@endsection
