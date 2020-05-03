@extends('backend.layouts.app')

@section('content')

    <div class="row">
      </div>
          <div class="card shadow">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col">
                  <h3 class="mb-0">Registrar nueva cita</h3>
                </div>
                <div class="col text-right">
                  <a href="{{ url('patients') }}" class="btn btn-sm btn-default">
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
                <form  action="{{ url('appointments') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label form="description">Descripcion</label>
                        <input value="{{ old('description') }}" name="description" id="description" type="text" class="form-control" placeholder="Describe brevemente la consulta" required>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label form="specialty">Especialidad</label>
                            <select name="specialty_id" id="specialty" class="form-control" required>
                                <option value="">Seleccionar especialidad</option>
                                @foreach ($especialidades as $especialidad)
                                    <option value="{{ $especialidad->id}}">{{ $especialidad->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label form="doctor">Médico</label>
                            <select name="doctor_id" id="doctor" class="form-control" required>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label form="email">Fecha</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                            </div>
                            <input class="form-control datepicker" placeholder="Seleccionar fecha"
                                id="date" name="scheduled_date" type="text" value="{{ date('Y-m-d') }}"
                                data-date-format="yyyy-mm-dd"
                                data-date-start-date="{{ date('Y-m-d') }}"
                                data-date-end-date="+30d">
                        </div>
                    </div>
                    <div class="form-group">
                        <label form="direccion">Hora de atención</label>
                        <div id="hours">
                            <div class="alert alert-info" role="alert">
                                No hay fechas disponibles!
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="type">Tipo de consulta</label>
                        <div class="custom-control custom-radio mb-3">
                            <input type="radio" id="type1" name="type" class="custom-control-input"
                            value="Consulta" checked>
                            <label class="custom-control-label" for="type1">Consulta</label>
                        </div>
                        <div class="custom-control custom-radio mb-3">
                            <input type="radio" id="type2" name="type" class="custom-control-input"
                            value="Examen">
                            <label class="custom-control-label" for="type2">Examen</label>
                        </div>
                        <div class="custom-control custom-radio mb-3">
                            <input type="radio" id="type3" name="type" class="custom-control-input"
                            value="Operacion">
                            <label class="custom-control-label" for="type3">Operacion</label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        Guardar
                    </button>
                </form>
            </div>
          </div>
@endsection

@section('scripts')
        <script src= {{ asset('backend/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}></script>
        <script src= {{ asset('backend/cita/create.js') }}></script>
@endsection