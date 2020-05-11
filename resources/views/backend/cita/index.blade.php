@extends('backend.layouts.app')

@section('content')

    <div class="row">
      </div>
          <div class="card shadow">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col">
                  <h3 class="mb-0">Mis citas</h3>
                </div>                
              </div>
            </div>
            <div class="card-body">
                @if(session('notificacion'))
                    <div class="alert alert-success" role="alert">
                    {{ session('notificacion') }}
                    </div>
                @endif                
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="pill" href="#citas-confirmadas" role="tab" aria-selected="true">Mis proximas citas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="pill" href="#citas-pendientes" role="tab" aria-selected="false">Citas por confirmar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="pill" href="#citas-historial" role="tab" aria-selected="false">Historial de cita</a>
                    </li>
                </ul>                
            </div>
            <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="citas-confirmadas" role="tabpanel">@include('backend.cita.citas-confirmadas')</div>
                    <div class="tab-pane fade" id="citas-pendientes" role="tabpanel">@include('backend.cita.citas-pendientes')</div>
                    <div class="tab-pane fade" id="citas-historial" role="tabpanel">@include('backend.cita.citas-historial')</div>
            </div>
          </div>
@endsection