@extends('layouts.admin')
@section('header')
    <h1>Pregled napomena</h1><hr>
    <a href="{{url('admin/napomene/nova')}}" class="btn btn-outline-success">Nova napomena</a>
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
     @if(session()->has('delete'))
            <div class="alert alert-danger" role="alert">
                <strong>{{session()->get('delete')}}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                    &times;</button>
            </div>
     @endif
    <div class="table-responsive">
        <table id="example" class="table table-striped table-bordered">
            <thead class="bg-info">
            <tr>
                <th scope="col">Korisnik</th>
                <th scope="col">Naziv</th>
                <th scope="col">Napomena stvorena</th>
                <th scope="col">Radnja</th>
            </tr>
            </thead>
            <tbody>
            @foreach($notes as $note)
            <tr>
                <td scope="row">{{$note->user->name}}</td>
                <td>{{$note->naslov}}</td>
                <td>{{$note->created_at->diffForHumans()}}</td>
                <td>
                    <form method="post" action="{{url('admin/napomene')}}/{{$note->id}}">
                        @csrf
                        {{method_field('delete')}}
                        <button type="submit" onclick="return confirm('Da li ste sigurni?')" class="btn btn-outline-danger">Izbriši  <i class="fa fa-trash"></i></button>
                    </form>
                </td>
            </tr>
            @endforeach
            </tbody>

        </table>
    </div>
    </div>
    
@endsection
