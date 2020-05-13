@extends('backend.layouts.app')

@section('content')

    <div class="row">
      </div>
          <div class="card shadow">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col">
                  <h3 class="mb-0">Detalle cita</h3>
                </div>                
              </div>
            </div>
            <div class="card-body">
              <ul>
                <li>
                  <strong>Descripcion:</strong> {{ $appointment->description }}
                </li>
                <li>
                  <strong>Fecha:</strong> {{ $appointment->scheduled_date }}
                </li>
                <li>
                  <strong>Hora:</strong> {{ $appointment->scheduled_time }}
                </li>
                <li>
                  <strong>Estado:</strong>
                  @if($appointment->estado == "Cancelada") 
                    <span class="badge badge-danger">Cancelada</span>
                  @else
                    <span class="badge badge-success">{{ $appointment->estado }}</span>
                  @endif
                </li>
                @if($role == "paciente" || $role == "admin")
                      <li><strong>Medico:</strong> {{ $appointment->doctor->name }}</li>
                @endif
                @if($role == "medico" || $role == "admin")
                      <li><strong>Paciente:</strong> {{ $appointment->patient->name }}</li>
                @endif
                <li>
                  <strong>Especialidad:</strong> {{ $appointment->specialty->nombre }}
                </li>
                <li>
                  <strong>Tipo:</strong> {{ $appointment->type }}
                </li>
              </ul>
                <div class="alert alert-dark">
                  <p>Acerca del pago::</p>
                  <ul>
                    <li>
                      <strong>Medio de pago:</strong> {{ $appointment->medio }}
                    </li>
                    <li>
                      <strong>Cantidad cuotas:</strong> {{ $appointment->cuotas }}
                    </li>
                    <li>
                      <strong>Importe ($):</strong> {{ $appointment->monto }}
                    </li>
                  </ul>
                </div>

                @if($appointment->estado == "Cancelada")
                  <div class="alert alert-dark">
                    <p>Acerca de la cancelacion:</p>
                    <ul>
                      @if($appointment->cancelacion)
                        <li>
                          <strong>Motivo cancelacion:</strong> {{ $appointment->cancelacion->justificacion }}
                        </li>
                        <li>
                          <strong>Fecha cancelacion:</strong> {{ $appointment->cancelacion->created_at }}
                        </li>
                        <li>
                          <strong>Usuario que cancelo:</strong> {{ $appointment->cancelacion->cancelado_por->name }}
                        </li>
                      @else
                        <li>Esta cita fue cancelada antes de su confirmacion</li>
                      @endif
                    </ul>
                  </div>
                @endif
              <a href="{{ url('/appointments/index') }}" class="btn btn-default">Volver</a>
            </div>           
          </div>
@endsection