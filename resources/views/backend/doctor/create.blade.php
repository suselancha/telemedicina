@extends('backend.layouts.app')

@section('content')

    <div class="row">
      </div>
          <div class="card shadow">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col">
                  <h3 class="mb-0">Nueva médico</h3>
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
                        <label form="email">Correo</label>
                        <input type="text" name="descripcion" class="form-control" value="{{ old('email')}}">
                    </div>
                    <div class="form-group">
                        <label form="matricula">Matrícula</label>
                        <input type="text" name="matricula" class="form-control" value="{{ old('matricula')}}">
                    </div>
                    <div class="form-group">
                        <label form="direccion">Dirección</label>
                        <input type="text" name="direccion" class="form-control" value="{{ old('direccion')}}">
                    </div>
                     <div class="form-group">
                        <label form="telefono">Teléfono</label>
                        <input type="text" name="telefono" class="form-control" value="{{ old('telefono')}}">
                    </div>
                    <button type="submit" class="btn btn-primary">
                        Guardar
                    </button>
                </form>
            </div>
          </div>
      
      
@endsection