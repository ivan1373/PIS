@extends('layouts.admin')
@section('header')
    <br>
    <h1>Pregled napomena</h1><hr>
    <a href="{{url('admin/napomene/nova')}}" class="btn btn-outline-success">Nova napomena</a>
    <br>
@endsection
@section('content')
    <div class="container">
    @if(session()->has('status'))
        <div class="alert alert-success" role="alert">
            <strong>{{session()->get('status')}}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                &times;</button>
        </div>
    @endif
    <div class="table-responsive">
        <table class="table">
            <caption>Prikazano je {{$notesCount}} napomena</caption>
            <thead class="bg-info">
            <tr>
                <th scope="col">Korisnik</th>
                <th scope="col">Naslov</th>
                <th scope="col">Radnja</th>
            </tr>
            </thead>
            <tbody>
            @foreach($notes as $note)
            <tr>
                <th scope="row">{{$note->user->name}}</th>
                <td>{{$note->naslov}}</td>
                <td>{{$note->created_at->diffForHumans()}}</td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    </div>
@endsection
