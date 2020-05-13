{{--SOLAMENTE PARA VISTAS SI CONOCE EL ENLACE PUEDE ENTRAR --}}
{{-- VER MIDDLEWARE PARA CONTROL --}}
<h6 class="navbar-heading text-muted">
    @if (auth()->user()->role == 'admin')
        Gestionar Datos
    @else
        Menú
    @endif
</h6>
<ul class="navbar-nav">
    @include('backend.parciales.menu.' . auth()->user()->role)
    <!--@if (auth()->user()->role == 'admin')
        @include('backend.parciales.menu.admin')
     @elseif (auth()->user()->role == 'medico')
        @include('backend.parciales.menu.medico')
     @else {{-- pacientes --}}
        @include('backend.parciales.menu.paciente')
     @endif-->
    <li class="nav-item">
    <a class="nav-link" href="" onclick="event.preventDefault(); document.getElementById('formLogout').submit();">
        <i class="ni ni-key-25 text-info"></i> Cerrar Sesion
    </a>
    <form action="{{ route('logout') }}" method="POST" style="display: none;" id="formLogout">
        @csrf
    </form>
    </li>
</ul>
{{-- @if (auth()->user()->role == 'admin')
    <hr class="my-3">
    <h6 class="navbar-heading text-muted">Reportes</h6>
    <ul class="navbar-nav mb-md-3">
        <li class="nav-item">
        <a class="nav-link" href="#">
            <i class="ni ni-spaceship"></i> Frecuencia de citas
        </a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="#">
            <i class="ni ni-palette"></i> Médicos más activos
        </a>
        </li>
    </ul>
@endif
--}}