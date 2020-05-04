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
    @if (auth()->user()->role == 'admin')
        <li class="nav-item">
        <a class="nav-link" href="/home">
            <i class="ni ni-tv-2 text-primary"></i> Dashboard
        </a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="/especialidades">
            <i class="ni ni-planet text-blue"></i> Especialidades
        </a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="/doctors">
            <i class="ni ni-pin-3 text-orange"></i> Medicos
        </a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="/patients">
            <i class="ni ni-single-02 text-yellow"></i> Pacientes
        </a>
        </li>
     @elseif (auth()->user()->role == 'medico')
        <li class="nav-item">
            <a class="nav-link" href="/schedule">
                <i class="ni ni-tv-2 text-primary"></i> Gestionar Horarios
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/especialidades">
                <i class="ni ni-planet text-blue"></i> Mis citas
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/doctors">
                <i class="ni ni-pin-3 text-orange"></i> Mis pacientes
            </a>
        </li>
     @else {{-- pacientes --}}
        <li class="nav-item">
            <a class="nav-link" href="/appointments/create">
                <i class="ni ni-tv-2 text-primary"></i> Reservar cita
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/especialidades">
                <i class="ni ni-planet text-blue"></i> Mis citas
            </a>
        </li>
     @endif
    <li class="nav-item">
    <a class="nav-link" href="" onclick="event.preventDefault(); document.getElementById('formLogout').submit();">
        <i class="ni ni-key-25 text-info"></i> Cerrar Sesion
    </a>
    <form action="{{ route('logout') }}" method="POST" style="display: none;" id="formLogout">
        @csrf
    </form>
    </li>
</ul>
@if (auth()->user()->role == 'admin')
    <!-- Divider -->
    <hr class="my-3">
    <!-- Heading -->
    <h6 class="navbar-heading text-muted">Reportes</h6>
    <!-- Navigation -->
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