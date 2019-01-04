@extends('layouts.admin')
@section('header')
    <h1>Račun za rezervaciju</h1><hr>
@endsection
@section('content')
    <div class="container">
        <div class="invoice p-3 mb-3">
            <!-- title row -->
            <div class="row">
                <div class="col-12">
                    <h4>
                        <i class="fa fa-globe"></i> Projektiranje informacijskih sustava
                        <small class="float-right">Datum: {{$today}}</small>
                    </h4>
                </div>
                <!-- /.col -->
            </div>
            <!-- info row -->
            <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                    Stvorio:
                    <address>
                        <strong>{{Auth::user()->name}}</strong><br>
                        {{Auth::user()->isadmin?'Adminstrator':'Recepcioner'}}<br>
                        Email: {{Auth::user()->email}}
                    </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                    Za:
                    <address>
                        <strong>{{$reservation->gost}}</strong><br>
                        Rezervacija od {{$startDate}} do {{$endDate}}
                    </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                    <b>Broj Računa:</b>
                    <br>
                    {{$reservation->id}}<br>
                    <b>Platiti do</b> {{$today}}<br>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- Table row -->
            <div class="row">
                <div class="col-12 table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Količina</th>
                            <th>Naziv Usluge</th>
                            <th>Opis</th>
                            <th>Cijena</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>{{$diff}}</td>
                            <td>Najam Sobe</td>
                            <td>Iznos za najam sobe/soba. Iznos je broj noći</td>
                            <td>{{$amount}}KM</td>
                        </tr>
                        <tr>
                            <td>{{$diff}}</td>
                            <td>Dorucak</td>
                            <td>Gost ima mogućnost izbora doručka, koji je besplatan</td>
                            <td>0.00KM</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <div class="row">
                <!-- accepted payments column -->
                <div class="col-6">
                    <p class="lead">Načini plaćanja:</p>
                    <img src="../../dist/img/credit/visa.png" alt="Visa">
                    <img src="../../dist/img/credit/mastercard.png" alt="Mastercard">
                    <img src="../../dist/img/credit/american-express.png" alt="American Express">
                    <img src="../../dist/img/credit/paypal2.png" alt="Paypal">

                    <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's
                        standard dummy text ever since the 1500s,
                        when an unknown printer took a galley of type and scrambled it to make a type specimen book
                    </p>
                </div>
                <!-- /.col -->
                <div class="col-6">
                    <p class="lead">Iznos do {{$endDate}}</p>

                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <th style="width:50%">Cijena:</th>
                                <td>{{$amount}}KM</td>
                            </tr>
                            <tr>
                                <th>PDV (17%)</th>
                                <td>{{$amount*0.17}}KM</td>
                            </tr>
                            <tr>
                                <th>Konačan iznos:</th>
                                <td>{{$total}}KM</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- this row will not appear when printing -->
            <div class="row no-print">
                <div class="col-12">
                    <button class="btn btn-default float-left" onclick="print()">Ispiši <i class="fa fa-print"></i></button>
                    <a href="{{url('admin/rezervacije')}}/{{$reservation->id}}"  class="btn btn-info float-right">Pohrani <i class="fa fa-download"></i></a>
                </div>
            </div>
        </div>
    </div>
@endsection
