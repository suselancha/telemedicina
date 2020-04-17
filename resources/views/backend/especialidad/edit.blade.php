@extends('backend.layouts.app')

@section('content')

    <div class="row">
      </div>
          <div class="card shadow">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col">
                  <h3 class="mb-0">Editar especialidad</h3>
                </div>
                <div class="col text-right">
                  <a href="{{ url('especialidades') }}" class="btn btn-sm btn-default">
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
                <form  action="{{ url('especialidades/'.$specialty->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label form="nombre">Nombre de la especialidad</label>
                        <input type="text" name="nombre" class="form-control" value="{{ old('nombre', $specialty->nombre)}}">
                    </div>
                    <div class="form-group">
                        <label form="descripcion">Descripcion</label>
                        <input type="text" name="descripcion" class="form-control" value="{{ old('descripcion', $specialty->descripcion)}}">
                    </div>
                    <button type="submit" class="btn btn-primary">
                        Guardar
                    </button>
                </form>
            </div>
          </div>
      
      
@endsection