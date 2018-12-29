@extends('layouts.admin')
@section('header')
    <h1>Lista korisnika</h1><hr>
@endsection
@section('content')
    <div class="container">

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
                <div class="row">
                    @foreach($users as $user)
                        <div class="col-4">
                            <div class="card text-center" style="width: 20rem;">
                                <img class="card-img-top" src="https://s-ec.bstatic.com/images/hotel/max1024x768/731/73118462.jpg" alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title">{{$user->name}}</h5>
                                    <p>E-Mail adresa: {{$user->email}}</p>
                                    <p>Vrsta računa: {{$user->isadmin==1?'ADMINISTRATOR':'RECEPCIONER'}}</p>
                                    <p>Registriran: {{\Carbon\Carbon::parse($user->created_at)->diffForHumans()}}</p>
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
                                    <a href="#" class="btn btn-outline-info">Uredi</a>
                                    <form method="post" action="#">
                                        @csrf
                                        {{ method_field('delete') }}
                                        <button type="submit" onclick="return confirm('Da li ste sigurni?')" class="btn btn-outline-danger">Izbriši</button>
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
