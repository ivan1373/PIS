<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <link rel="shortcut icon" type="image/x-icon" href="{{url('/images/favicon.ico')}}" />
  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js" integrity="sha256-oSgtFCCmHWRPQ/JmR4OoZ3Xke1Pw4v50uh6pLcu+fIc=" crossorigin="anonymous"></script>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-laravel navbar-dark border-bottom">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{url('admin')}}" class="nav-link"><i class="fa fa-tachometer"></i>&nbsp;Administracijsko sučelje</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
          <a class="nav-link" href="{{url('admin/rezervacije')}}">
              <i class="fa fa-bell-o"></i>
              @if($brojZavrsenih > 0)
              <span title="Imate {{$brojZavrsenih}} zavrsenih rezervacija" class="badge badge-warning navbar-badge">{{$brojZavrsenih}}</span>
              @endif
          </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#"><i
            class="fa fa-th-large"></i></a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{url('admin')}}" class="brand-link">
      <img src="{{url('/storage/images')}}/{{Auth::user()->slika}}" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Administracija</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{url('/storage/images')}}/{{Auth::user()->slika}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a class="d-block">{{ Auth::user()->name }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="{{url('admin/sobe')}}" class="nav-link">
              <i class="fa fa-bed nav-icon"></i>
              <p>Sobe</p>
            </a>
          </li>
          <li class="nav-item">
              <a href="{{url('admin/rezervacije')}}" class="nav-link">
                <i class="fa fa-bell nav-icon"></i>
                <p>Rezervacije</p>
              </a>
          </li>

          <li class="nav-item">
              <a href="{{url('admin/napomene')}}" class="nav-link">
                <i class="fa fa-comments nav-icon"></i>
                <p>Napomene</p>
              </a>
          </li>

            @if(Auth::user()->isadmin)
          <li class="nav-item">
              <a href="{{url('admin/korisnici')}}" class="nav-link">
                <i class="fa fa-users nav-icon"></i>
                <p>Korisnici</p>
              </a>
          </li>
            @endif
          <li class="nav-item">
              <a href="{{url('admin/izvjestaj')}}" class="nav-link">
                  <i class="fa fa-file nav-icon"></i>
                  <p>Dnevni Izvještaj</p>
              </a>
          </li>
           <li class="nav-item">
                <a href="{{url('/')}}" class="nav-link">
                    <i class="fa fa-home nav-icon"></i>
                    <p>Početna Stranica</p>
                </a>
           </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid text-center">
          <br>
        @yield('header')
          <br>
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <br>
      @yield('content')
        <br>
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
    <br>
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5 class="text-center"><i class="fa fa-user"></i>&nbsp;{{Auth::user()->name}}<br>{{Auth::user()->isadmin?'ADMINISTRATOR':'RECEPCIONER'}}</h5><br>
      <a href="{{url('admin/izmjena')}}" class="nav-link"><i class="fa fa-cog"></i>&nbsp;Izmjena podataka</a>
      <a href="{{url('admin/logout')}}" class="nav-link"><i class="fa fa-sign-out"></i>&nbsp;Odjava</a>
    </div>
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      Projektiranje informacijskih sustava 2018 | Ivan Miloš
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2014-2018 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<!-- Bootstrap 4 -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {



        function print()
        {
            $('.invoice').printThis({
                header: null,               // prefix to html
                footer: null,
            });
        }


        $('#example').DataTable( {
            "language": {
            "sEmptyTable":      "Nema podataka u tablici",
            "sInfo":            "Prikazano _START_ do _END_ od _TOTAL_ rezultata",
            "sInfoEmpty":       "Prikazano 0 do 0 od 0 rezultata",
            "sInfoFiltered":    "(filtrirano iz _MAX_ ukupnih rezultata)",
            "sInfoPostFix":     "",
            "sInfoThousands":   ",",
            "sLengthMenu":      "Prikaži _MENU_ rezultata po stranici",
            "sLoadingRecords":  "Dohvaćam...",
            "sProcessing":      "Obrađujem...",
            "sSearch":          "Pretraži:",
            "sZeroRecords":     "Ništa nije pronađeno",
            "oPaginate": {
                "sFirst":       "Prva",
                "sPrevious":    "Nazad",
                "sNext":        "Naprijed",
                "sLast":        "Zadnja"
            },
            "oAria": {
                "sSortAscending":  ": aktiviraj za rastući poredak",
                "sSortDescending": ": aktiviraj za padajući poredak"
            }
          }
        } );

    } );


</script>




</body>
</html>
