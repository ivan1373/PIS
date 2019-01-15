@extends('layouts.admin')
@section('header')
    <h1>Detalji za sobu <b>{{$room->naziv}}</b></h1><hr>
@endsection
@section('content')
    <div class="container">
        <div class="card {{$room->status?'card-danger':'card-success'}}">
            <div class="card-header">
                <h3 class="card-title text-center">{{$room->naziv}}</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <div class="card-body text-center">
                <p>Stvorena: {{$room->created_at->diffForHumans()}}</p><br>
                <p>Broj Kreveta: {{$room->room_type->br_kreveta}}</p><br>
                @if($room->status)
                    <p>Ime Gosta: {{$room->reservations->gost}}</p><br>
                    <p>Trajanje aktualne rezervacije: {{Carbon\Carbon::parse($room->reservations->datum_od)->format('d.m.Y.')}} do {{Carbon\Carbon::parse($room->reservations->datum_do)->format('d.m.Y.')}}</p>
                @endif
            </div>
                <!-- /.card-body -->
            <div class="card-footer">
                <a style="float:right;" href="{{url('admin/sobe')}}" class="btn btn-outline-success">Natrag</a>
            </div>

        </div>
    </div>
@endsection
