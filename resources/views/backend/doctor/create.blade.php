@extends('backend.layouts.app')

@section('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
@endsection

@section('content')
    <div class="row">
      </div>
          <div class="card shadow">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col">
                  <h3 class="mb-0">Nuevo médico</h3>
                </div>
                <div class="col text-right">
                  <a href="{{ url('doctors') }}" class="btn btn-sm btn-default">
                    Cancelar y volver
                  </a>
                </div>
              </div>
            </div>
            <div class="card-body">
                @if($errors->any())
                    <div class="alert alert-danger" role="alert">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{  $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form  action="{{ url('doctors') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label form="name">Nombre del médico</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name')}}">
                    </div>
                    <div class="form-group">
                        <label form="matricula">Dni</label>
                        <input type="text" name="dni" class="form-control" value="{{ old('dni')}}">
                    </div>
                    <div class="form-group">
                        <label form="matricula">Matrícula</label>
                        <input type="text" name="matricula" class="form-control" value="{{ old('matricula')}}">
                    </div>
                    <div class="form-group">
                        <label form="email">Correo</label>
                        <input type="text" name="email" class="form-control" value="{{ old('email')}}">
                    </div>
                    <div class="form-group">
                        <label form="direccion">Dirección</label>
                        <input type="text" name="direccion" class="form-control" value="{{ old('direccion')}}">
                    </div>
                    <div class="form-group">
                        <label form="telefono">Teléfono</label>
                        <input type="text" name="telefono" class="form-control" value="{{ old('telefono')}}">
                    </div>
                    <div class="form-group">
                        <label form="telefono">Contraseña</label>
                        <input type="text" name="password" class="form-control" value="{{ Str::random(6)}}">
                    </div>
                    <div class="form-group">
                        <label form="telefono">Especialidades</label>
                        <select name="specialties[]" id="specialties" class="form-control selectpicker" data-style="btn-default" multiple title="Seleccione una o unas">
                            @foreach ($especialidades as $especialidad)
                                <option value="{{ $especialidad->id }}">{{ $especialidad->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="" class="form-control-label">Precio Consulta</label>
                        <input class="form-control" type="number" value="{{ old('consulta')}}" name="consulta">
                    </div>
                    <button type="submit" class="btn btn-primary">
                        Guardar
                    </button>
                </form>
            </div>
          </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
@endsection