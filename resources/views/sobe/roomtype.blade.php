@extends('layouts.admin')
@section('header')
    <h1>Vrste Soba</h1><hr>
@endsection
@section('content')
    <div class="container">

    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
        <li class="nav-item">
            <a class="btn btn-outline-info active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Popis</a>
        </li>&nbsp;
        <li class="nav-item">
            <a class="btn btn btn-outline-info" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Nova vrsta</a>
        </li>
    </ul>

    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
            @if(session()->has('status'))
                <div class="alert alert-success" role="alert">
                    <strong>{{session()->get('status')}}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                        &times;</button>
                </div>
            @endif
            @if(session()->has('status1'))
                    <div class="alert alert-success" role="alert">
                        <strong>{{session()->get('status1')}}</strong>
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
            @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                            &times;</button>
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>

                    </div>
                @endif
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered">
                        <thead class="bg-info">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Broj kreveta</th>
                            <th scope="col">Cijena noćenja</th>
                            <th scope="col">Radnja</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($types as $type)
                            <tr>
                                <th scope="row">{{$type->id}}</th>
                                <td>{{$type->br_kreveta}}</td>
                                <td>{{$type->cijena}}</td>
                                <td>
                                    <a href="{{url('admin/sobe/vrste')}}/{{$type->id}}/{{('izmjena')}}" class="btn btn-outline-info">Uredi</a>
                                    <form method="post" action="{{url('admin/sobe/vrste')}}/{{$type->id}}">
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
        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Nova vrsta sobe</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->

                <form role="form" action="{{url('admin/sobe/vrste')}}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label>Broj Kreveta</label>
                            <input type="number" name="br_kreveta" class="form-control" placeholder="Unesite broj kreveta...">
                        </div>
                        <div class="form-group">
                            <label>Cijena</label>
                            <input type="number" name="cijena" class="form-control" placeholder="Unesite cijenu noćenja sobe...">
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-outline-info">Stvori</button>
                        <button type="reset" class="btn btn-outline-warning">Poništi</button>
                        <a style="float:right;" href="{{url('admin/sobe')}}" class="btn btn-outline-success">Natrag</a>
                    </div>
                </form>
            </div>

        </div>
    </div>
    </div>
@endsection
