@extends('layouts.admin')
@section('header')
    <h1>Rezervacije</h1><hr>
    <a href="{{url('admin/rezervacije/nova')}}" class="btn btn-outline-success">Nova rezervacija <i class="fa fa-plus" ></i></a>
@endsection
@section('content')
    <div class="container">
        <div class="table-responsive">
            <table id="example" class="table display">
                <thead class="bg-info">
                    <tr>
                        <th>Ime Gosta</th>
                        <th>Početak</th>
                        <th>Kraj</th>
                        <th>Broj Soba</th>
                        <th>Radnja</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($reservations as $reservation)
                    <tr>
                        <th>{{$reservation->gost}}</th>
                        <th>{{$reservation->datum_od}}</th>
                        <th>{{$reservation->datum_do}}</th>
                        <th>{{$reservation->rooms->count()}}</th>
                        <th>
                            <a href="#" class="btn btn-outline-info">Izmjena</a>
                            <a href="#" class="btn btn-outline-success">Završi</a>
                        </th>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
