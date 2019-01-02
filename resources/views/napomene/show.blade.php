@extends('layouts.admin')
@section('header')
    <h1>{{$note->naslov}}</h1>
    <p class="cite">{{$note->created_at->diffForHumans()}}</p>
    <p class="cite">Korisnik: {{$note->user->name}}</p>
    <hr>
    <a href="{{url('admin/napomene')}}" class="btn btn-outline-success">Natrag <i class="fa fa-arrow-left"></i></a>
@endsection
@section('content')
    <div class="container text-center">
        <h4>{{$note->tijelo_nap}}</h4>
    </div>
@endsection
