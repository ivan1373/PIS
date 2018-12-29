@extends('layouts.admin')
@section('header')
    <h1>Izmjena detalja sobe</h1><hr>
@endsection
@section('content')
    <div class="container">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Izmijenite detalje sobe</h3>
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
            <form role="form" action="{{url('admin/sobe/')}}/{{$room->id}}" method="POST">
                @csrf
                {{method_field('PUT')}}
                <div class="card-body">
                    <div class="form-group">
                        <label>Naziv sobe</label>
                        <input type="text" name="naziv" class="form-control" value="{{$room->naziv}}">
                    </div>
                    <div class="form-group">
                        <label>Trenutni podaci</label>
                        <input type="text" class="form-control" value="Broj kreveta: {{$room->room_type->br_kreveta}}" disabled><br>
                        <input type="text" class="form-control" value="Cijena: {{$room->room_type->cijena}}" disabled>
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
                    <button type="submit" class="btn btn-outline-info">Potvrdi</button>
                    <button type="reset" class="btn btn-outline-warning">Poništi</button>
                    <a style="float:right;" href="{{url('admin/sobe')}}" class="btn btn-outline-success">Natrag</a>
                </div>
            </form>
        </div>
    </div>
@endsection
