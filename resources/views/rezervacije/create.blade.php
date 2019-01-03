@extends('layouts.admin')
@section('header')
    <h1>Stvaranje rezervacije</h1><hr>
@endsection
@section('content')
    <div class="container">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Nova rezervacija</h3>
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
            <form role="form" action="{{url('admin/rezervacije/nova')}}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label>Ime gosta</label>
                        <input type="text" name="gost" class="form-control" placeholder="Unesite ime gosta...">
                    </div>
                    <div class="form-group">
                        <label>Datum Od</label>
                        <input type="date" name="datum1" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Datum Do</label>
                        <input type="date" name="datum2" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Odaberite sobu/sobe</label><br>
                        @foreach($rooms as $room)
                        <input type="checkbox" name="soba[]" value="{{$room->id}}"> Naziv Sobe: <b>{{$room->naziv}}</b>, Broj Kreveta: <b>{{$room->room_type->br_kreveta}}</b><br>
                        @endforeach
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
                    <button type="submit" class="btn btn-outline-info">Stvori</button>
                    <button type="reset" class="btn btn-outline-warning">Poništi</button>
                    <a style="float:right;" href="{{url('admin/rezervacije')}}" class="btn btn-outline-success">Natrag</a>
                </div>
            </form>
        </div>
    </div>
@endsection
