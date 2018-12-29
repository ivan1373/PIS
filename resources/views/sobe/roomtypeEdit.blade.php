@extends('layouts.admin')
@section('header')
    <h1>Izmjena detalja</h1><hr>
@endsection
@section('content')
    <div class="container">
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Izmijenite detalje vrste sobe</h3>
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
        <form role="form" action="{{url('admin/sobe/vrste')}}/{{$roomType->id}}" method="POST">
            @csrf
            {{method_field('PUT')}}
            <div class="card-body">
                <div class="form-group">
                    <label>Broj Kreveta{{$roomType->br_kreveta}}</label>
                    <input type="number" name="br_kreveta" class="form-control" value="{{$roomType->br_kreveta}}">
                </div>
                <div class="form-group">
                    <label>Cijena</label>
                    <input type="number" name="cijena" class="form-control" value="{{$roomType->cijena}}">
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <button type="submit" class="btn btn-outline-info">Potvrdi</button>
                <button type="reset" class="btn btn-outline-warning">Poništi</button>
                <a style="float:right;" href="{{url('admin/sobe/vrste')}}" class="btn btn-outline-success">Natrag</a>
            </div>
        </form>
    </div>
    </div>
@endsection
