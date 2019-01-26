@extends('layouts.app')

@section('content')
    <br>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-light navbar-laravel">Potvrdite vašu E-Mail adresu</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            Poveznica za potvrdu je poslan na vašu E-Mail adresu
                        </div>
                    @endif

                    Prije nastavka provjerite vašu E-Mail adresu za poveznicu za potvrdu
                    Ako niste primili E-Mail, <a href="{{ route('verification.resend') }}">kliknite ovdje za ponovni zahtjev</a>.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
