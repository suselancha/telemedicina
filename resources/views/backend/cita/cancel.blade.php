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

                <p>Estas a punto de cancelar tu cita reservada con el medico {{ $appointment->doctor->name}} para el dia: {{ $appointment->scheduled_date }}</p>

                <form action="{{ url('/appointments/'.$appointment->id.'/postCancel') }}" method="POST">
                    @csrf
                    <form-group>
                        <label for="justificacion">Por favor, cuentanos el motivo de la cancelacion:</label>
                        <textarea required id="justificacion" name="justificacion" rows="3" class="form-control">
                        
                        </textarea>
                    </form-group>
                    <button class="bnt btn-danger" type="submit">Cancelar cita</button>
                    <a href="{{ url('/appointments/index') }}" class="btn btn-default">
                        Volver a "Mis citas"
                    </a>
                </form>

            </div>           
          </div>
@endsection