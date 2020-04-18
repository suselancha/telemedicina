@extends('backend.layouts.app')

@section('content')

    <div class="row">
      </div>
          <div class="card shadow">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col">
                  <h3 class="mb-0">Editar paciente</h3>
                </div>
                <div class="col text-right">
                  <a href="{{ url('patients') }}" class="btn btn-sm btn-default">
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
                <form  action="{{ url('patients/'.$paciente->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label form="name">Nombre del paciente</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $paciente->name)}}">
                    </div>
                    <div class="form-group">
                        <label form="matricula">Dni</label>
                        <input type="text" name="dni" class="form-control" value="{{ old('dni', $paciente->dni)}}">
                    </div>
                    <div class="form-group">
                        <label form="email">Correo</label>
                        <input type="text" name="email" class="form-control" value="{{ old('email', $paciente->email)}}">
                    </div>
                    <div class="form-group">
                        <label form="direccion">Dirección</label>
                        <input type="text" name="direccion" class="form-control" value="{{ old('direccion', $paciente->direccion)}}">
                    </div>
                    <div class="form-group">
                        <label form="telefono">Teléfono</label>
                        <input type="text" name="telefono" class="form-control" value="{{ old('telefono', $paciente->telefono)}}">
                    </div>
                    <div class="form-group">
                        <label form="password">Contraseña</label>
                        <input type="text" name="password" class="form-control" value="">
                        <p>Ingrese un valor si solo desea modificar la contraseña</p>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        Guardar
                    </button>
                </form>
            </div>
          </div>
      
      
@endsection