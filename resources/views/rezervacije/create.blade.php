@extends('layouts.admin')
@section('header')
    <h1>Stvaranje rezervacije</h1><hr>
@endsection
@section('content')
    <div class="container">
        <div class="table-responsive">
            <table id="example" class="table display">
                <thead>
                    <tr>
                        <th>Naziv</th>
                        <th>Broj Kreveta</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($rooms as $room)
                    <tr>
                        <td>{{$room->naziv}}</td>
                        <td>{{$room->room_type->br_kreveta}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
