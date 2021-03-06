@extends('layouts.admin')
@section('header')
    <h1>Pregled Soba</h1>
    <hr>@can('create',\App\Room::class)<a href="{{url('admin/sobe/nova')}}" class="btn btn-outline-success">Dodaj Sobu <i class="fa fa-plus"></i></a>@endcan
        <a href="{{url('admin/sobe/vrste')}}" class="btn btn-outline-info">Vrste Soba <i class="fa fa-list"></i></a>
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
        @if(session()->has('update'))
            <div class="alert alert-success" role="alert">
                <strong>{{session()->get('update')}}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                    &times;</button>
            </div>
        @endif
        @if(session()->has('delete'))
            <div class="alert alert-danger" role="alert">
                <strong>{{session()->get('delete')}}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                    &times;</button>
            </div>
        @endif

        <div class="row">
            @foreach($rooms as $room)
            <div class="col-sm-4" align="center">
                <div class="card" style="width: 20rem;">
                    <img class="card-img-top" src="https://s-ec.bstatic.com/images/hotel/max1024x768/731/73118462.jpg" alt="Card image cap">
                    <div class="card-body {{$room->status?'bg-danger':''}}">
                        <h5 class="card-title">{{$room->naziv}}</h5><hr>
                        <p>Broj Kreveta: {{$room->room_type->br_kreveta}}</p>
                        <p>Broj Rezervacija: {{$room->reservations->count()}}</p>
                        <p>Cijena noćenja: {{$room->room_type->cijena}}KM</p>
                        <hr>
                        <a href="{{url('admin/sobe')}}/{{$room->id}}" class="btn btn-outline-info" >Detalji <i class="fa fa-info"></i></a>
                        @can('update',$room)&nbsp;
                        <a href="{{url('admin/sobe')}}/{{$room->id}}/{{('izmjena')}}" class="btn btn-outline-success" >Izmjena <i class="fa fa-cog"></i></a>
                        @endcan
                        <hr>
                        @can('delete',$room)
                        <form method="post" action="{{url('admin/sobe')}}/{{$room->id}}">
                            @csrf
                            {{ method_field('delete') }}
                            <button type="submit" onclick="return confirm('Da li ste sigurni?')" class="btn btn-outline-danger">Izbriši <i class="fa fa-trash"></i></button>
                        </form>
                        @endcan
                    </div>
                </div>
            </div>
            @endforeach
        </div>

    </div>
@endsection
