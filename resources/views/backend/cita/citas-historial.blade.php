<div class="table-responsive">
              <!-- Projects table -->
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>                    
                    <th scope="col">Especialidad</th>
                    @if($role == "paciente")
                      <th scope="col">Medico</th>
                    @elseif($role == "medico")
                      <th scope="col">Paciente</th>
                    @endif
                    <th scope="col">Fecha</th>
                    <th scope="col">Hora</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Opciones</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($citasHistorial as $cita)
                  <tr>
                    <th scope="row">
                      {{ $cita->specialty->nombre }}
                    </th>
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
                      {{ $cita->estado }}
                    </td>
                    <td>                      
                        <a href="{{ url('/appointments/'.$cita->id) }}" class="btn btn-primary btn-sm">Detalle</a>
                    </td>
                  </tr>
                  @endforeach
                </tbody> 
              </table>
</div>
<div class="card-body">
    {{ $citasHistorial->links() }}
</div>