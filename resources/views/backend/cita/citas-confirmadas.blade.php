<div class="table-responsive">
              <!-- Projects table -->
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">Descripcion</th>
                    <th scope="col">Especialidad</th>
                    <th scope="col">Medico</th>
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
                    <td>
                      {{ $cita->doctor->name }}
                    </td>
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