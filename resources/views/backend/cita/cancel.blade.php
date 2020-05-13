@extends('backend.layouts.app')

@section('content')

    <div class="row">
      </div>
          <div class="card shadow">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col">
                  <h3 class="mb-0">Cancelar cita</h3>
                </div>                
              </div>
            </div>
            <div class="card-body">
                @if(session('notificacion'))
                    <div class="alert alert-success" role="alert">
                    {{ session('notificacion') }}
                    </div>
                @endif              

                @if($role == "paciente")
                  <p>Estas a punto de cancelar tu cita reservada con el medico {{ $appointment->doctor->name}} para el dia: {{ $appointment->scheduled_date }}</p>
                @elseif($role == "medico")
                  <p>Estas a punto de cancelar tu cita con el paciente {{ $appointment->patient->name}} para el dia: {{ $appointment->scheduled_date }} - hora: {{ $appointment->scheduled_time }}</p>
                @else
                  <p>Estas a punto de cancelar la cita reservada por el paciente {{ $appointment->patient->name}} para ser atendido por el medico {{ $appointment->doctor->name}} para el dia: {{ $appointment->scheduled_date }}- hora: {{ $appointment->scheduled_time }}</p>
                @endif

                <form action="{{ url('/appointments/'.$appointment->id.'/postCancel') }}" method="POST">
                    @csrf
                    <form-group>
                        <label for="justificacion">Por favor, cuentanos el motivo de la cancelacion:</label>
                        <textarea required id="justificacion" name="justificacion" rows="3" class="form-control"></textarea>
                    </form-group>
                    <button class="bnt btn-sm btn-danger" type="submit">Cancelar cita</button>
                    <a href="{{ url('/appointments/index') }}" class="btn btn-sm btn-default">
                        Volver a "Mis citas"
                    </a>
                </form>

            </div>           
          </div>
@endsection