@extends('layouts.admin')
@section('header')
    <br>
    <h1>Stvaranje sobe</h1>
    <hr>
    <br>
@endsection
@section('content')
    <div class="container">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Nova soba</h3>
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
            <form role="form" action="{{url('admin/sobe/nova')}}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label>Naziv</label>
                        <input type="text" name="naziv" class="form-control" placeholder="Unesite naziv sobe...">
                    </div>
                    <div class="form-group">
                        <label>Odaberite vrstu sobe</label>
                        <select name="vrsta" class="form-control">
                            @foreach($types as $type)
                            <option value="{{$type->id}}">Broj kreveta: {{$type->br_kreveta}}, cijena: {{$type->cijena}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-outline-info">Stvori</button>
                    <button type="reset" class="btn btn-outline-warning">Poništi</button>
                    <a style="float:right;" href="{{url('admin/sobe')}}" class="btn btn-outline-success">Natrag</a>
                </div>
            </form>
        </div>
    </div>
@endsection
