@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-info">Početna stranica</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    Prijavljeni ste u sustav!<br>
                    Za nastavak rada odaberite Administraciju
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
