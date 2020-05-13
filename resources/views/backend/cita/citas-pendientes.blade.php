<div class="table-responsive">
              <!-- Projects table -->
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">Descripcion</th>
                    <th scope="col">Especialidad</th>
                    @if($role == "paciente")
                      <th scope="col">Medico</th>
                    @elseif($role == "medico")
                      <th scope="col">Paciente</th>
                    @endif
                    <th scope="col">Fecha</th>
                    <th scope="col">Hora</th>
                    <th scope="col">Tipo</th>                    
                    <th scope="col">Opciones</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($citasReservadas as $cita)
                  <tr>
                    <th scope="row">
                      {{ $cita->description }}
                    </th>
                    <td>
                      {{ $cita->specialty->nombre }}
                    </td>
                    @if($role == "paciente")
                      <td>{{ $cita->doctor->name }}</td>
                    @elseif($role == "medico")
                      <td>{{ $cita->patient->name }}</td>
                    @endif
                    <td>
                      {{ $cita->scheduled_date }}
                    </td>
                    <td>
                      {{ $cita->scheduled_time_12 }} {{--VER ACCESOR EN EL MODELO--}}
                    </td>
                    <td>
                      {{ $cita->type }}
                    </td>
                    <td>
                    @if($role == "admin")
                        <a class="btn btn-sm btn-primary" title="Ver cita" href="{{ url('/appointments/'.$cita->id) }}">
                        Ver
                        </a>
                    @endif
                    @if($role == "medico" || $role == "admin")     
                      <form action="{{ url('/appointments/'.$cita->id.'/confirmar') }}" method="POST" class="d-inline-block">
                        @csrf
                        <button class="btn btn-sm btn-success" title="Confirmar cita" type="submit">Confirmar</button>
                      </form>
                      <a href="{{ url('/appointments/'.$cita->id.'/cancel') }}"
                        class="btn btn-sm btn-danger">
                        Cancelar
                      </a>
                    @else {{-- Si es paciente no explica porque cancela --}}
                      <form action="{{ url('/appointments/'.$cita->id.'/postCancel') }}" method="POST" class="d-inline-block">
                        @csrf
                        <button title="Cancelar cita" class="btn btn-sm btn-danger" type="submit">Cancelar</button>
                      </form>
                    @endif
                    </td>
                  </tr>
                  @endforeach
                </tbody> 
              </table>
</div>
<div class="card-body">
    {{ $citasReservadas->links() }}
</div>