@extends('layouts.admin')
@section('header')
    <h1>DobroDošli {{Auth::user()->name}}</h1><hr>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-6">
                <div class="small-box bg-danger-gradient">
                    <div class="inner">
                        <h3>{{$reservations}}</h3>
                        <p>Aktivnih Rezervacija</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-bell"></i>
                    </div>
                    <a href="{{url('admin/rezervacije')}}" class="small-box-footer">Više informacija <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{$rooms}}</h3>
                        <p>Soba</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-bed"></i>
                    </div>
                    <a href="{{url('admin/sobe')}}" class="small-box-footer">Više informacija <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-warning-gradient">
                    <div class="inner">
                        <h3>{{$users}}</h3>
                        <p>Registriranih Korisnika</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-users"></i>
                    </div>
                    <a href="{{url('admin/korisnici')}}" class="small-box-footer">Više informacija <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-success-gradient">
                    <div class="inner">
                        <h3>{{$notes}}</h3>
                        <p>Napomena</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-sticky-note"></i>
                    </div>
                    <a href="{{url('admin/napomene')}}" class="small-box-footer">Više informacija <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
        <br><br>
        <div class="row">
            <div class="col-sm-6 col-12">
                <canvas id="myChart" width="400" height="400"></canvas>
            </div>
            <div class="col-sm-6 col-12">
                <canvas id="myChart2" width="400" height="400"></canvas>
            </div>
        </div><br>
        <div class="row bg-light-gradient">
            <div class="col-sm-2"></div>
            <div class="col-sm-8">
                <canvas id="myChart3" width="400" height="400"></canvas>
            </div>
            <div class="col-sm-2"></div>
        </div>
    </div>
    <script>

        var ctx = document.getElementById("myChart");
        var myChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ["Administrator", "Recepcioner"],
                datasets: [{
                    label: 'broj korisnika',
                    data: [{{$adminsCount}}, {{$recsCount}}],
                    backgroundColor: [
                        '#17A2B8',
                        '#343A40'
                    ],
                    borderColor: [
                        '#17A2B8',
                        '#343A40'
                    ],
                    borderWidth: 1
                }]
            },

            options: {
                title: {
                    display: true,
                    text: 'Korisnik/vrsta računa',
                    fontSize: 18
                }
            },

        });

        var ctx2 = document.getElementById("myChart2");
        var myChart2 = new Chart(ctx2, {
            type: 'doughnut',
            data: {
                labels: ["Rezervirane", "Slobodne"],
                datasets: [{
                    label: 'odnos soba',
                    data: [{{$reservedCount}}, {{$freeRoomCount}}],
                    backgroundColor: [
                        '#17A2B8',
                        '#343A40'
                    ],
                    borderColor: [
                        '#17A2B8',
                        '#343A40'
                    ],
                    borderWidth: 1
                }]
            },

            options: {
                title: {
                    display: true,
                    text: 'Rezervirane/slobodne sobe',
                    fontSize: 18
                }
            },

        });

        var ctx3 = document.getElementById("myChart3");
        var myBarChart = new Chart(ctx3, {
            type: 'bar',
            data: {
                labels: [
                    @for($i = 0;$i < 10; $i++)
                    "{{\Carbon\Carbon::now()->addYear($i)->year}}",
                    @endfor
                ],
                datasets: [{
                    label: 'broj rezervacija po godinama',
                    data: [
                        @forEach($arrayOfResCount as $num)
                        {{$num}},
                        @endforeach
                    ],
                    backgroundColor:  '#17A2B8',
                    borderColor: '#343A40',
                    borderWidth: 1
                }]
            },
            options: {
                title: {
                    display: true,
                    text: 'Odnos broja rezervacija po godinama',
                    fontSize: 18
                }
            }
        });
    </script>
@endsection
