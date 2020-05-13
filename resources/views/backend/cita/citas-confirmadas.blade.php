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
                    @foreach($citasConfirmadas as $cita)
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
                        <a class="btn btn-sm btn-danger" title="Cancelar cita" href="{{ url('/appointments/'.$cita->id.'/cancel') }}">
                        Cancelar
                        </a>
                    </td>
                  </tr>
                  @endforeach
                </tbody> 
              </table>
</div>
<div class="card-body">
    {{ $citasConfirmadas->links() }}
</div>