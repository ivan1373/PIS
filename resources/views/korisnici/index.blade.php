@extends('layouts.admin')
@section('header')
    <h1>Lista korisnika</h1><hr>
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
        @if(session()->has('delete'))
                <div class="alert alert-danger" role="alert">
                    <strong>{{session()->get('delete')}}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                        &times;</button>
                </div>
        @endif
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item">
                <a class="btn btn-outline-info active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Kartice</a>
            </li>&nbsp;
            <li class="nav-item">
                <a class="btn btn btn-outline-info" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Tablica</a>
            </li>
        </ul>
        <br>
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                <div class="row text-center">
                    @foreach($users as $user)
                        <div class="col-lg-4 col-12">
                            <div class="card text-center" style="width: 18rem;">
                                <img class="card-img-top" src="{{url('/storage/images')}}/{{$user->slika}}" alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title">{{$user->name}}</h5>
                                    <p>E-Mail adresa: {{$user->email}}</p>
                                    <p>Vrsta računa: {{$user->isadmin==1?'ADMINISTRATOR':'RECEPCIONER'}}</p>
                                    <p>Registriran: {{\Carbon\Carbon::parse($user->created_at)->diffForHumans()}}</p>
                                    <hr>
                                    <a href="#" class="btn btn-outline-info" >Detalji <i class="fa fa-info"></i></a>&nbsp;
                                    <a href="{{url('admin/korisnici')}}/{{$user->id}}/{{('izmjena')}}" class="btn btn-outline-success" >Izmjena <i class="fa fa-cog"></i></a>
                                    <hr>
                                    <form method="post" action="#">
                                        @csrf
                                        {{ method_field('delete') }}
                                        <button type="submit" onclick="return confirm('Da li ste sigurni?')" class="btn btn-outline-danger">Izbriši <i class="fa fa-trash"></i></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered">
                        <thead class="bg-info">
                        <tr>
                            <th scope="col">Ime</th>
                            <th scope="col">E-Mail</th>
                            <th scope="col">Vrsta računa</th>
                            <th scope="col">Registriran</th>
                            <th>Radnja</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <th scope="row">{{$user->name}}</th>
                                <td>{{$user->email}}</td>
                                <td>{{$user->isadmin=='1'?'ADMINISTRATOR':'RECEPCIONER'}}</td>
                                <td>{{\Carbon\Carbon::parse($user->created_at)->diffForHumans()}}</td>
                                <td>
                                    <a href="{{url('admin/korisnici')}}/{{$user->id}}/{{('izmjena')}}" class="btn btn-outline-info">Uredi  <i class="fa fa-cog"></i></a>
                                    <form method="post" action="#">
                                        @csrf
                                        {{ method_field('delete') }}
                                        <button type="submit" onclick="return confirm('Da li ste sigurni?')" class="btn btn-outline-danger">Izbriši <i class="fa fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
