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
                <p>Broj Kreveta: {{$room->room_type->br_kreveta}}</p><br><hr>
                <p>Aktualne rezervacije:</p>
                @forelse($reservations as $reservation)
                <p>{{$reservation->gost}}, od {{\Carbon\Carbon::parse($reservation->datum_od)->format('d. m. Y.')}} do {{\Carbon\Carbon::parse($reservation->datum_do)->format('d. m. Y.')}}</p><br>
                @empty
                <p>Trenutno nema aktivnih rezervacija</p>
                @endforelse
            </div>
                <!-- /.card-body -->
            <div class="card-footer">
                <a style="float:right;" href="{{url('admin/sobe')}}" class="btn btn-outline-success">Natrag</a>
            </div>

        </div>
    </div>
@endsection
