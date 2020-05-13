<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <!--meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"-->
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">  
  <title>Sistema de Reserva de Citas | {{ config('app.name') }}</title>
  <!-- Favicon -->
  <link href="{{ asset('backend/img/brand/favicon.png') }}" rel="icon" type="image/png">
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <!-- Icons -->
  <link href="{{ asset('backend/vendor/nucleo/css/nucleo.css') }}" rel="stylesheet">
  <link href="{{ asset('backend/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
  <!-- Argon CSS -->
  <link type="text/css" href="{{ asset('backend/css/argon.css?v=1.0.0') }}" rel="stylesheet">
  @yield('styles')
</head>

<body>
  <!-- Sidenav -->
  <nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
      <!-- Toggler -->
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <!-- Brand -->
      <a class="navbar-brand pt-0" href="./index.html">
        <img src="{{ asset('backend/img/brand/blue.png') }}" class="navbar-brand-img" alt="...">
      </a>
      <!-- User -->
      <ul class="nav align-items-center d-md-none">
        
        <li class="nav-item dropdown">
          @include('backend.parciales.dropdown_menu')
        </li>
      </ul>
      <!-- Collapse -->
      <div class="collapse navbar-collapse" id="sidenav-collapse-main">
        <!-- Collapse header -->
        <div class="navbar-collapse-header d-md-none">
          <div class="row">
            <div class="col-6 collapse-brand">
              <a href="./index.html">
                <img src="{{ asset('backend/img/brand/blue.png') }}">
              </a>
            </div>
            <div class="col-6 collapse-close">
              <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                <span></span>
                <span></span>
              </button>
            </div>
          </div>
        </div>
        @include('backend.parciales.menu')        
      </div>
    </div>
  </nav>
  <!-- Main content -->
  <div class="main-content">
    <!-- Top navbar -->
    <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
      <div class="container-fluid">
        <!-- Brand -->
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="/home">Panel de Administración</a>
        <!-- Form -->
        <!--form class="navbar-search navbar-search-dark form-inline mr-3 d-none d-md-flex ml-lg-auto">
          <div class="form-group mb-0">
            <div class="input-group input-group-alternative">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-search"></i></span>
              </div>
              <input class="form-control" placeholder="Search" type="text">
            </div>
          </div>
        </form-->
        <!-- User -->
        <ul class="navbar-nav align-items-center d-none d-md-flex">
          <li class="nav-item dropdown">
            <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <div class="media align-items-center">
            
                <div class="media-body ml-2 d-none d-lg-block">
                @if(auth()->user()->role == "medico")
                  <span class="mb-0 text-sm  font-weight-bold">Dr/a: {{ auth()->user()->name  }}</span>
                @elseif(auth()->user()->role == "paciente")
                  <span class="mb-0 text-sm  font-weight-bold">Paciente: {{ auth()->user()->name  }}</span>
                @else
                  <span class="mb-0 text-sm  font-weight-bold">Administrador: {{ auth()->user()->name  }}</span>
                @endif
                </div>
              </div>
            </a>
            @include('backend.parciales.dropdown_menu')
          </li>
        </ul>
      </div>
    </nav>
    <!-- Header -->
    <div class="header bg-gradient-primary pb-8 pt-4 pt-md-6">
      <div class="container-fluid">
        <div class="header-body">
          <!-- Card stats -->
          <div class="row">
            
          </div>
        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--7">
      @yield('content')
      <!-- Footer -->
      @include('backend.parciales.footer')
    </div>
  </div>
  <!-- Argon Scripts -->
  <!-- Core -->
  <script src="{{ asset('backend/vendor/jquery/dist/jquery.min.js') }}"></script>
  <script src="{{ asset('backend/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
  <!-- Optional JS -->
  <script src="{{ asset('backend/vendor/chart.js/dist/Chart.min.js') }}"></script>
  <script src="{{ asset('backend/vendor/chart.js/dist/Chart.extension.js') }}"></script>
  <!-- Argon JS -->
  @yield('scripts')
  <script src="{{ asset('backend/js/argon.js?v=1.0.0') }}"></script>
  
</body>

</html>