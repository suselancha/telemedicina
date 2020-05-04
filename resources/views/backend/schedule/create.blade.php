@extends('backend.layouts.app')

@section('content')
<form action="/schedule" method="post">
    @csrf
    <div class="row">
      </div>
            <div class="card shadow">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="mb-0">Nuevo horario</h3>
                        </div>
                        <div class="col text-right">
                            <a href="{{ url('schedule') }}" class="btn btn-sm btn-default">
                                Cancelar y volver
                            </a>
                            <button type="submit" class="btn btn-sm btn-success">
                                Guarda cambios
                            </button>
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
                </div>
                    <div class="table-responsive">
                        <!-- Projects table -->
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col">Fecha</th>                                
                                <th scope="col">Turno mañana</th>
                                <th scope="col">Turno tarde</th>
                            </tr>
                            </thead>
                            <tbody>
                            @for($j=0;$j<5;++$j)
                                <tr>
                                    <th>
                                        <input type="text" name="day[]" class="form-control datepicker"                                            
                                            data-date-format="yyyy-mm-dd"
                                            data-date-start-date="{{ date('Y-m-d') }}"
                                            data-date-end-date="+30d">
                                    </th>                                    
                                    <td>
                                        <div class="row">
                                            <div class="col">
                                                <select class="form-control" name="morning_start[]">
                                                        <option value="0">Sin atencion</option>
                                                    @for ($i=5;$i<=13;$i++)
                                                        <option value="{{ ($i<10 ? '0' : '') . $i }}:00">{{ $i }}:00 AM</option>
                                                        <option value="{{ ($i<10 ? '0' : '') . $i }}:30">{{ $i }}:30 AM</option>
                                                    @endfor
                                                </select>
                                            </div>
                                            <div class="col">
                                                <select class="form-control" name="morning_end[]">>
                                                        <option value="0">Sin atencion</option>
                                                    @for ($i=5;$i<=13;$i++)
                                                        <option value="{{ ($i<10 ? '0' : '') . $i }}:00">{{ $i }}:00 AM</option>
                                                        <option value="{{ ($i<10 ? '0' : '') . $i }}:30">{{ $i }}:30 AM</option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="row">
                                            <div class="col">
                                                <select class="form-control" name="afternoon_start[]">
                                                        <option value="0">Sin atencion</option>
                                                    @for ($i=14;$i<=20;$i++)
                                                        <option value="{{ $i }}:00">{{ $i }}:00 PM</option>
                                                        <option value="{{ $i }}:30">{{ $i }}:30 PM</option>
                                                    @endfor
                                                </select>
                                            </div>
                                            <div class="col">
                                                <select class="form-control" name="afternoon_end[]">>
                                                        <option value="0">Sin atencion</option>
                                                    @for ($i=14;$i<=20;$i++)
                                                        <option value="{{ $i }}:00">{{ $i }}:00 PM</option>
                                                        <option value="{{ $i }}:30">{{ $i }}:30 PM</option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endfor
                            </tbody>
                        </table>
                    </div>
            </div>
</form>
@endsection

@section('scripts')
        <script src= {{ asset('backend/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}></script>
@endsection