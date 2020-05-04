@extends('backend.layouts.app')

@section('content')
    <form action="{{ url('/schedule') }}" method="post">
        @csrf
        <div class="row">
            </div>
          <div class="card shadow">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col">
                  <h3 class="mb-0">Gestionar horarios</h3>
                </div>
                <div class="col text-right">
                  <a href="{{ url('schedule/create') }}" class="btn btn-sm btn-success">
                    Nuevo horario 
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

              @if(session('errors'))
                <div class="alert alert-danger" role="alert">
                  Los cambios se han guardado pero tener en cuenta que:
                  <ul>
                  @foreach (session('errors') as $error )
                      <li>{{ $error }}</li>
                  @endforeach
                  </ul>
                </div>
              @endif
            </div>
            <div class="table-responsive">
              <!-- Projects table -->
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">Fecha</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Turno mañana</th>
                    <th scope="col">Turno tarde</th>
                    <th scope="col">Acciones</th>
                  </tr>
                </thead>
                <tbody>
                @foreach ($workDays as $work)
                    <tr>
                      <th scope="row">
                        {{ $work->day}}
                      </th>              
                      <td>
                        {{ $work->active}}
                      </td>
                      <td>
                        {{ $work->morning_start}} - 
                        {{ $work->morning_end}}
                      </td>
                      <td>
                        {{ $work->afternoon_start}} - 
                        {{ $work->afternoon_end}}
                      </td>
                      <td>
                      <form  action="{{ url('schedule/'.$work->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <a href="{{ url('/schedule/'.$work->id.'/edit') }}" class="btn btn-sm btn-primary">Editar</a>
                        <button class="btn btn-sm btn-danger" type="submit">Eliminar</button>
                      </form> 
                      </td>
                    </tr>
                @endforeach
                </tbody>
              </table>
            </div>
            <div class="card-body">
              {{ $workDays->links() }}
            </div>
          </div>
    </form>
@endsection
