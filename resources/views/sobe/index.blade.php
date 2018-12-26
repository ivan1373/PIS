@extends('layouts.admin')
@section('header')
    <br>
    <h1>Pregled Soba</h1>
    <hr><a href="{{url('admin/sobe/nova')}}" class="btn btn-outline-success">Dodaj Sobu</a>
        <a href="{{url('admin/sobe/vrste')}}" class="btn btn-outline-info">Vrste Soba</a>
    <br>
@endsection
@section('content')
    <div class="container"><br>
        @if(session()->has('status'))
            <div class="alert alert-success" role="alert">
                <strong>{{session()->get('status')}}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                    &times;</button>
            </div>
        @endif
        @foreach($rooms as $room)
        <div class="row">
            <div class="col-sm-4" align="center">
                <div class="card" style="width: 20rem;">
                    <img class="card-img-top" src="https://s-ec.bstatic.com/images/hotel/max1024x768/731/73118462.jpg" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">{{$room->naziv}}</h5>
                        <p>Broj Kreveta: {{$room->room_type->br_kreveta}}</p>
                        <p>{{$room->status=='1'?'REZERVIRANA':'SLOBODNA'}}</p>
                        <hr>
                        <a href="#" class="btn btn-outline-info" >Detalji <i class="fa fa-info"></i></a>&nbsp;
                        <a href="#" class="btn btn-outline-success" >Izmjena <i class="fa fa-cog"></i></a>
                        <hr>
                        <form method="post" action="#">
                            @csrf
                            {{ method_field('delete') }}
                            <button type="submit" onclick="return confirm('Da li ste sigurni?')" class="btn btn-outline-danger">Izbriši <i class="fa fa-trash"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
@endsection
