@extends('backend.layouts.app')

@section('content')
    <div class="row">
      </div>
          <div class="card shadow">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col">
                  <h3 class="mb-0">Pagar y Confirmar cita</h3>
                </div>
                <div class="col text-right">
                  <a href="{{ url('appointments/create') }}" class="btn btn-sm btn-default">
                    Cancelar y volver
                  </a>
                </div>
              </div>
            </div>
            <div class="card-body">
             @if(session('notificacion'))
                <div class="alert alert-success" role="alert">
                  {{ session('notificacion') }}
                </div>
              @endif
                @if($errors->any())
                    <div class="alert alert-danger" role="alert">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{  $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form  action="{{ url('appointments/pagar') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <ul>
                            <li>Descripcion: {{ $data['description']}}</li>
                            <input type="hidden" name="description" value="{{ $data['description']}}">
                            <li>Especialidad: {{ $data['nombre_esp']}}</li>
                            <input type="hidden" name="specialty_id" value="{{ $data['specialty_id']}}">
                            <li>Médico: {{ $data['nombre_doc']}}</li>
                            <input type="hidden" name="doctor_id" value="{{ $data['doctor_id']}}">
                            <li>Fecha: {{ $data['scheduled_date']}}</li>
                            <input type="hidden" name="scheduled_date" value="{{ $data['scheduled_date']}}">
                            <li>Hora de atención: {{ $data['scheduled_time'] }}</li>
                            <input type="hidden" name="scheduled_time" value="{{ $data['scheduled_time']}}">
                            <li>Tipo de consulta: {{ $data['type'] }}</li>
                            <input type="hidden" name="type" value="{{ $data['type']}}">
                            <li>Costo consulta: {{ $data['consulta'] }}</li>
                            <input type="hidden" name="consulta" value="{{ $data['consulta']}}">
                        </ul>
                    </div>                    
                    <script
                        src="https://www.mercadopago.com.ar/integrations/v1/web-tokenize-checkout.js"
                        data-public-key="TEST-f718ec65-86df-4525-af2f-73c035963b84"
                        data-transaction-amount="<?php echo $data['consulta']?>">
                    </script>
                    <img class="card-img-top" src="{{ asset('/img/mercadopago.png') }}" alt="Card image cap">
                </form>
            </div>
          </div>
@endsection
{{--TEST-f718ec65-86df-4525-af2f-73c035963b84--}}
