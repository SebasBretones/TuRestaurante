@extends('main')

@section('title')
  <div class="titulo tapas-header">
    <div class="container text-center">
      <div class="row">
        <div class="col-lg-12">
          <h1>Platos</h1>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('content')

<div class="row justify-content-between mt-4">
  <div class="col-4">
   <button data-bs-toggle="modal" data-bs-target="#crearTapa" type="button" class="btn btn-success">Crear</button>
  </div>
  <div class="col-4">
    <form class="input-group" action="{{route('tapas.index')}}" method="GET">
      <input type="text" class="form-control" name="search" placeholder="Buscar" value="{{request()->query('search')}}">
    </form>
  </div>
</div>

@if (count($tapas)==0)
<div class="card login-card mtg">
    <div class="row no-gutters"">
        <div class="col-md-12">
            <div class="card-body text-center">
                @if (request()->query('search'))
                No se han encontrado registros para la busqueda de <strong>{{request()->query('search')}}</strong>
                @else
                ¡Crea tu primer plato! Los platos aparecerán en la <a class="sinestilo" href="{{route('cartas.index')}}" target="_blank">carta</a>
                y podrás realizar pedidos con ellas
                @endif
            </div>
        </div>
    </div>
</div>

<div class="alert alert-success alert-dismissible fade show bottomf text-center" role="alert">
    <strong>¡Comienza pulsando el botón de crear!</strong>
    <button type="button" class="btn-close btn-close" aria-label="Close" data-dismiss="alert"></button>
</div>
@else
  <div class="row mt-2">
    <div class="col-md-12">
      <div class="table100 ver3 res m-b-110">
        <table data-vertable="ver3">
          <thead>
              <tr class="row100 head">
              <th class="column1">Nombre</th>
              <th class="column2">Precio</th>
              <th class="column3">Tipo</th>
              <th class="column4">
              </th>
              </tr>
          </thead>
          <tbody>
            @foreach ($tapas as $tapa)
              <tr class="row100">
                <td class="column1">{{$tapa->nombre}}</td>
                <td class="column2">{{$tapa->precio}} €</td>
                <td class="column3">
                  @php
                      $tipo = '\App\Models\Tipotapa'::find($tapa->tipotapa_id);
                  @endphp
                  {{$tipo->nombre}}
                </td>
                <td class="column4">
                  <div class="btn-group">
                    <button class="btn btn-success" type="button"
                    data-tapa_id="{{$tapa->id}}" data-nombre="{{$tapa->nombre}}" data-precio="{{$tapa->precio}}"
                    data-tipotapa_id="{{$tapa->tipotapa_id}}" data-disponible="{{$tapa->disponible}}" data-bs-toggle="modal" data-bs-target="#editarTapa">Editar</button>
                    <form name="f" action="{{route('tapas.destroy', $tapa)}}"  method="POST">
                      @csrf
                      @method('DELETE')
                      <div class="ms-2">
                      <button class="btn btn-danger" type="submit" onclick="return confirm('¿Estás seguro de que quieres eliminar el plato {{$tapa->nombre}}?')">Borrar</button>
                      </div>
                    </form>
                  </div>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endif
@include('partials._paginator', ['array' => $tapas])

<!--Modal crear-->
<div class="modal fade" id="crearTapa" tabindex="-1" aria-labelledby="crearTapaLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
  <div class="modal-content">
      <div class="modal-header">
      <h5 class="modal-title" id="crearTapaLabel">Crear</h5>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form name="f" action="{{route('tapas.store')}}" method="POST">
          @csrf
          <div class="col">
              <label for="nombre" class="col-form-label">Nombre</label>
              <input type="text" class="form-control" name="nombre" placeholder="Nombre" id="nombre">
          </div>
          <div class="col">
            <label for="precio" class="col-form-label">Precio</label>
            <input type="number" class="form-control" name="precio" placeholder="Precio" id="precio" step="any">
         </div>
            @php
                $tipos = DB::table('tipotapas')->get();
            @endphp
            <div class="col">
                <label for="tipo_tapa_id" class="col-form-label">Tipo de plato</label>
                <select name="tipotapa_id" class="form-select form-select-sm" aria-label=".form-select-sm example">
                    @foreach ($tipos as $item)
                        <option value="{{$item->id}}">{{$item->nombre}}</option>
                    @endforeach
                </select>
            </div>
            <div class="justify-content-between">
                <hr>
                <div class="left">
                    <button class="btn" type="button" data-bs-toggle="modal" data-bs-target="#info">
                        <span class="material-icons">info</span>
                    </button>
                </div>
                <div class="right">
                    <button class="btn btn-warning" type="reset">Resetear</button>
                    <button type="submit" class="btn btn-success">Crear</button>
                </div>
            </div>
      </form>
      </div>
  </div>
  </div>
</div>

<!--Modal editar-->
<div class="modal fade" id="editarTapa" tabindex="-1" aria-labelledby="editarTapaLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
  <div class="modal-content">
      <div class="modal-header">
      <h5 class="modal-title" id="editarTapaLabel">Editar</h5>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form name="f" id="editarTapa" action="{{route('tapas.update','tapa_id')}}" method="POST">
          @csrf
          @method('PUT')
          <div class="col">
            <label for="nombre" class="col-form-label">Nombre</label>
            <input type="text" class="form-control" name="nombre" placeholder="Nombre" id="nombre_edit">
          </div>
          <input type="hidden" name="id" id="tapa_id" value="">
          <div class="col">
            <label for="precio" class="col-form-label">Precio</label>
            <input type="number" class="form-control" name="precio" placeholder="Precio" id="precio_edit" step="any">
          </div>
          @php
            $tipos = DB::table('tipotapas')->get();
          @endphp
          <div class="col">
            <label for="tipo_tapa_id" class="col-form-label">Tipo de plato</label>
            <select name="tipotapa_id" id="tipotapa_id_edit" class="form-select form-select-sm" aria-label=".form-select-sm example">
                @foreach ($tipos as $item)
                    <option value="{{$item->id}}">{{$item->nombre}}</option>
                @endforeach
            </select>
          </div>
          <div class="row mt-3">
            <div class="col">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="disponible" id="disponible" value="0">
                        <label class="form-check-label" for="disponible">
                        No Disponible
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="disponible" id="disponible2" value="1">
                        <label class="form-check-label" for="disponible2">
                        Disponible
                        </label>
                    </div>
                </div>
            </div>
            <div class="justify-content-between">
                <hr>
                <div class="left">
                    <button class="btn" type="button" data-bs-toggle="modal" data-bs-target="#infoe">
                        <span class="material-icons">info</span>
                    </button>
                </div>
                <div class="right">
                    <button class="btn btn-warning" type="reset">Resetear</button>
                    <button type="submit" class="btn btn-success">Editar</button>
                </div>
            </div>
      </form>
      </div>
  </div>
  </div>
</div>

<div class="modal fade" id="info" tabindex="-1" aria-labelledby="infoLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="infoLabel">Información</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body infom">
            <div class="card login-card">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-body">
                            - Nombre: indica un nombre identificativo para el plato. Debe ser único y no tener más de 120 caracteres.
                        </div>
                    </div>
                </div>
            </div>

            <div class="card login-card mt-1">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-body">
                            - Precio: indica un precio que se encuentre entre 0.05 y 200 €.
                        </div>
                    </div>
                </div>
            </div>

            <div class="card login-card mt-1">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-body">
                            - Tipo: indica el tipo de plato. Las raciones deberán pedirse sin bebidas, mientras que las tapas se pueden pedir
                            con cualquier tipo de bebidas.
                        </div>
                    </div>
                </div>
            </div>

            <div class="justify-content-start">
                <hr>
                <div>
                    <button type="button" class="btn btn-primary"  data-bs-toggle="modal" data-bs-dismiss="modal">Entendido</button></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="infoe" tabindex="-1" aria-labelledby="infoLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="infoLabel">Información</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body infom">
            <div class="card login-card">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-body">
                            - Nombre: indica un nombre identificativo para el plato. Debe ser único y no tener más de 120 caracteres.
                        </div>
                    </div>
                </div>
            </div>

            <div class="card login-card mt-1">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-body">
                            - Precio: indica un precio que se encuentre entre 0.05 y 200 €.
                        </div>
                    </div>
                </div>
            </div>

            <div class="card login-card mt-1">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-body">
                            - Tipo: indica el tipo de plato. Las raciones deberán pedirse sin bebidas, mientras que las tapas se pueden pedir
                            con cualquier tipo de bebidas.
                        </div>
                    </div>
                </div>
            </div>

            <div class="card login-card mt-1">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-body">
                            - Disponibilidad: indica su disponibilidad. Si no se encuentra disponible, no se podrán realizar pedidos nuevos con este plato
                            ni editarlos los ya hechos. Si están en preparación o finalizados, podrás entregarlos o eliminarlos.
                        </div>
                    </div>
                </div>
            </div>

            <div class="justify-content-start">
                <hr>
                <div>
                    <button type="button" class="btn btn-primary"  data-bs-toggle="modal" data-bs-dismiss="modal">Entendido</button></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
    <script src="{{ asset('js/edit_tapa.js') }}"></script>
    <script src="{{ asset('js/validate_tapa.js') }}"></script>
@endsection
