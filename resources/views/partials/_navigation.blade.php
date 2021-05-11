<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" id="logo" href="{{route('inicio')}}">INICIO</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav">
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
                  <li><hr class="dropdown-divider"></li>
                  <li><a class="dropdown-item" href="{{route('distribucionmesas.create')}}">Crear nuevo tipo de distribución</a></li>
                </ul>
            </li>
        </ul>
        <ul class="navbar-nav">
          <li class="nav-item dropdown">
              <a class="nav-link" href="{{route('tapas.index')}}">Tapas</a>
          </li>
      </ul>
      </div>
    </div>
</nav>
