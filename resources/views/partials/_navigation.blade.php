<nav class="navbar navbar-expand-md navbar-light bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" id="logo" href="{{route('inicio')}}">INICIO</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      @if (Auth::check())
      <div class="collapse navbar-collapse justify-content-between" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto" id="aNavbar">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">  Distribución y Mesas  </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <li><a class="dropdown-item" href="{{route('distribucionmesas.index')}}">Todos los tipos >></a>
                    <ul class="submenu dropdown-menu">
                        @foreach ($distribucionV as $distribucionmesa)
                        <li><a class="dropdown-item" href="{{route('distribucionmesas.show',$distribucionmesa)}}">{{$distribucionmesa->nombre}}</a></li>
                        @endforeach
                    </ul>
                  </li>
                </ul>
            </li>
          <li class="nav-item">
              <a class="nav-link" href="{{route('tapas.index')}}">Tapas</a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="{{route('bebidas.index')}}">Bebidas</a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="{{route('cartas.index')}}">Carta</a>
          </li>
        </ul>
        @else
        <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
        @endif
        <ul class="navbar-nav ml-auto">
          @guest
              @if (Route::has('login'))
                  <li class="nav-item">
                      <a class="nav-link" href="{{ route('login') }}">{{ __('Iniciar sesión') }}</a>
                  </li>
              @endif

              @if (Route::has('register'))
                  <li class="nav-item">
                      <a class="nav-link" href="{{ route('register') }}">{{ __('Registrar') }}</a>
                  </li>
              @endif
          @else
              <li class="nav-item dropdown">
                  <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                      {{ Auth::user()->name }}
                  </a>

                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                      <a class="dropdown-item" href="{{ route('logout') }}"
                         onclick="event.preventDefault();
                                       document.getElementById('logout-form').submit();">
                          {{ __('Cerrar sesión') }}
                      </a>

                      <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                          @csrf
                      </form>
                  </div>
              </li>
          @endguest
        </ul>
      </div>
    </div>
</nav>
