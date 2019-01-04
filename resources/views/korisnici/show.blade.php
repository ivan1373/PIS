@extends('layouts.admin')
@section('header')
    <h1>Detalji korisnika {{$user->name}}</h1><hr>
@endsection
@section('content')
    <div class="container">
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item">
                <a class="btn btn-outline-info active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Rezervacije</a>
            </li>&nbsp;
            <li class="nav-item">
                <a class="btn btn btn-outline-info" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Napomene</a>
            </li>
        </ul>
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">

                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Rezervacije korisnika {{$user->name}}</h3>
                    </div>
                        <div class="card-body">
                            <div class="list-group">
                                @foreach($reservations as $reservation)
                                <a class="list-group-item list-group-item-action flex-column align-items-start">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h5 class="mb-1">{{$reservation->gost}}</h5>
                                        <small>{{$reservation->created_at->diffForHumans()}}</small>
                                    </div>
                                    <p class="mb-1">Trajanje: od {{\Carbon\Carbon::parse($reservation->datum_od)->format('d-m-Y')}} do {{\Carbon\Carbon::parse($reservation->datum_do)->format('d-m-Y')}}</p>
                                    <small>{{$reservation->naplacena?'ZAVRSENA':'U TIJEKU'}}</small>
                                </a>
                                @endforeach
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <a style="float:right;" href="{{url('admin/korisnici')}}" class="btn btn-outline-success">Natrag</a>
                        </div>
                </div>
            </div>
            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Napomene korisnika {{$user->name}}</h3>
                    </div>
                    <div class="card-body">
                        <div class="list-group">
                            @foreach($notes as $note)
                                <a class="list-group-item list-group-item-action flex-column align-items-start">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h5 class="mb-1">{{$note->naslov}}</h5>
                                        <small>{{$note->created_at->diffForHumans()}}</small>
                                    </div>
                                    <p class="mb-1">{{$note->tijelo_nap}}</p>
                                </a>
                            @endforeach
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <a style="float:right;" href="{{url('admin/korisnici')}}" class="btn btn-outline-success">Natrag</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
