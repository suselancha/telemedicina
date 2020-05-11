<div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">              
              <a href="#!" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('formLogout').submit();">
                <i class="ni ni-user-run"></i>
                <form action="{{ route('logout') }}" method="POST" style="display: none;" id="formLogout">
                  @csrf
                </form>
                <span>Cerrar sesión</span>
              </a>
            </div>