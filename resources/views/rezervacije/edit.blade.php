@extends('layouts.admin')
@section('header')
    <h1>Izmjena detalja rezervacije</h1><hr>
@endsection
@section('content')
    <div class="container">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Ažuriranje rezervacije</h3>
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
            <form role="form" action="{{url('admin/rezervacije')}}/{{$reservation->id}}" method="POST">
                @csrf
                {{method_field('PUT')}}
                <div class="card-body">
                    <div class="form-group">
                        <label>Ime gosta</label>
                        <input type="text" name="gost" class="form-control" value="{{$reservation->gost}}">
                    </div>
                    <div class="form-group">
                        <label>Datum Od</label>
                        <input type="date" name="datum1" class="form-control" value="{{$reservation->datum_od}}">
                    </div>
                    <div class="form-group">
                        <label>Datum Do</label>
                        <input type="date" name="datum2" class="form-control" value="{{$reservation->datum_do}}">
                    </div>
                    <div class="form-group">
                        <p class="text-bold">Doručak</p>
                        <div>
                            <input type="radio" name="dorucak" value="1"
                                   checked>
                            <label>Da</label>
                        </div>
                        <div>
                            <input type="radio" name="dorucak" value="0">
                            <label>Ne</label>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-outline-info">Potvrdi</button>
                    <button type="reset" class="btn btn-outline-warning">Poništi</button>
                    <a style="float:right;" href="{{url('admin/rezervacije')}}" class="btn btn-outline-success">Natrag</a>
                </div>
            </form>
        </div>
    </div>
@endsection
