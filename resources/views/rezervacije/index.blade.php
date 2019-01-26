@extends('layouts.admin')
@section('header')
    <h1>Rezervacije</h1><hr>
    <a href="{{url('admin/rezervacije/provjera')}}" class="btn btn-outline-success">Nova rezervacija <i class="fa fa-plus" ></i></a>
@endsection
@section('content')
    <div class="container">
        @if(session()->has('update'))
            <div class="alert alert-success" role="alert">
                <strong>{{session()->get('update')}}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                    &times;</button>
            </div>
        @endif
         @if(session()->has('create'))
                <div class="alert alert-success" role="alert">
                    <strong>{{session()->get('create')}}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                        &times;</button>
                </div>
         @endif
         @if(session()->has('invoice'))
                <div class="alert alert-success" role="alert">
                    <strong>{{session()->get('invoice')}}</strong>
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
        <div class="table-responsive">
            <table id="example" class="table display">
                <thead class="bg-info">
                    <tr>
                        <th>Ime Gosta</th>
                        <th>Početak</th>
                        <th>Kraj</th>
                        <th>Naziv Sobe</th>
                        <th>Radnja</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($reservations as $reservation)
                    <tr class="{{$reservation->zavrsena?'finished':''}}">
                        <th>{{$reservation->gost}}</th>
                        <th>{{$reservation->datum_od}}</th>
                        <th>{{$reservation->datum_do}}</th>
                        <th>{{$reservation->rooms->naziv}}</th>
                        <th>
                        @if($reservation->zavrsena == 0)<a href="{{url('admin/rezervacije')}}/{{$reservation->id}}/{{('izmjena')}}" class="btn btn-outline-info">Izmjena</a>@endif
                            @if($reservation->zavrsena)<a href="{{url('admin/rezervacije')}}/{{$reservation->id}}/{{('racun')}}" class="btn btn-outline-success">Završi</a>@endif
                            @can('delete',$reservation)
                                <form method="post" action="{{url('admin/rezervacije')}}/{{$reservation->id}}">
                                    @csrf
                                    {{ method_field('delete') }}
                                    <button type="submit" onclick="return confirm('Da li ste sigurni?')" class="btn btn-outline-danger">Izbriši <i class="fa fa-trash"></i></button>
                                </form>
                            @endcan
                        </th>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
