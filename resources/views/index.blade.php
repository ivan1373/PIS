@extends('layouts.app')
@section('content')
    <header class="business-header bg-gray-light">

    </header>
    <div style="padding:75px 0;" class="container text-center">
        <br>
        <div class="row">
            <div class="col-12 col-sm-4">
                <div class="card mb-4 shadow" style="width: 20rem;height: 20rem;">
                    <img class="card-img-top" src="{{url('/images/html5.png')}}" alt="Card image cap">
                    <div class="card-body border-dark">
                        <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-4">
                <div class="card mb-4 shadow" style="width: 20rem;height: 20rem;">
                    <img class="card-img-top" src="{{url('/images/laravel.png')}}" alt="Card image cap">
                    <div class="card-body">
                        <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-4">
                <div class="card mb-4 shadow" style="width: 20rem;height: 20rem;">
                    <img class="card-img-top" src="{{url('/images/mysql.jpg')}}" alt="Card image cap">
                    <div class="card-body">
                        <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
