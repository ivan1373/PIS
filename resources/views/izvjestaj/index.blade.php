@extends('layouts.admin')
@section('header')
    <h1>Izvještaj za dan {{$today}}</h1><hr>
@endsection
@section('content')
    <div class="container">
        <div class="invoice p-3 mb-3">
            <!-- title row -->
            <div class="row">
                <div class="col-12">
                    <h4>
                        <i class="fa fa-globe"></i> Projektiranje Informacijskih Sustava
                        <small class="float-right">Datum: {{$today}}</small>
                    </h4>
                </div>
                <!-- /.col -->
            </div>
            <!-- info row -->
            <div class="row invoice-info">
                <div class="col-12">
                    Stvorio:
                    <address>
                        <strong>{{Auth::user()->name}}</strong><br>
                        {{Auth::user()->isadmin?'Administrator':'Recepcioner'}}<br>
                        Email: {{Auth::user()->email}}
                    </address>
                </div>
            </div>
            <!-- /.row -->

            <!-- Table row -->
            <div class="row">
                <div class="col-12 table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Novih napomena</th>
                            <th>Registriranih korisnika</th>
                            <th>Novih rezervacija</th>
                            <th>Slobodnih soba</th>
                            <th>Ukupno soba</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>{{$notesCount}}</td>
                            <td>{{$usersCount}}</td>
                            <td>{{$reservationsCount}}</td>
                            <td>{{$freeRoomsCount}}</td>
                            <td>{{$roomsCount}}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
            <!-- this row will not appear when printing -->
            <div class="row no-print">
                <div class="col-12">
                    <button class="btn btn-primary float-right" onclick="print()" style="margin-right: 5px;">
                        Ispis <i class="fa fa-print"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <script>

    </script>
@endsection
