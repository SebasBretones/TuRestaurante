@extends('main')

@section('title')
  <div class="titulo bebidas-header">
    <div class="container text-center">
      <div class="row">
        <div class="col-lg-12">
          <h1>Bebidas</h1>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('content')

<div class="row justify-content-between mt-4">
  <div class="col-4">
    <button data-bs-toggle="modal" data-bs-target="#crearBebida" type="button" class="btn btn-success">Crear</button>
  </div>
  <div class="col-4">
    <form class="input-group" action="{{route('bebidas.index')}}" method="GET">
      <input type="text" class="form-control" name="search" placeholder="Buscar" value="{{request()->query('search')}}">
    </form>
  </div>
</div>

@if (count($bebidas)==0)

<div class="card login-card mtg">
    <div class="row no-gutters"">
        <div class="col-md-12">
            <div class="card-body text-center">
                @if (request()->query('search'))
                No se han encontrado registros para la busqueda de <strong>{{request()->query('search')}}</strong>
                @else
                ¡Crea tu primera bebida! Las bebidas aparecerán en la <a class="sinestilo" href="{{route('cartas.index')}}" target="_blank">carta</a>
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
                  <th class="column4"></th>
                </tr>
            </thead>
            <tbody>
              @foreach ($bebidas as $bebida)
              <tr class="row100">
                <td class="column1">{{$bebida->nombre}}</td>
                <td class="column2">{{$bebida->precio}}</td>
                <td class="column3">
                  @php
                      $tipo = '\App\Models\Tipobebida'::find($bebida->tipobebida_id);
                  @endphp
                  {{$tipo->nombre}}
                </td>
                <td class="column4">
                  <div class="btn-group">
                    <button class="btn btn-success" type="button"
                    data-bebida_id="{{$bebida->id}}" data-nombre="{{$bebida->nombre}}" data-precio="{{$bebida->precio}}"
                    data-tipobebida_id="{{$bebida->tipobebida_id}}" data-disponible="{{$bebida->disponible}}" data-bs-toggle="modal" data-bs-target="#editarBebida">Editar</button>
                    <form name="f" action="{{route('bebidas.destroy', $bebida)}}"  method="POST">
                      @csrf
                      @method('DELETE')
                      <div class="ms-2">
                        <button class="btn btn-danger" type="submit" onclick="return confirm('¿Estás seguro de que quieres eliminar la bebida {{$bebida->nombre}}?')">Borrar</button>
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


@include('partials._paginator', ['array' => $bebidas])

<!--Modal crear-->
<div class="modal fade" id="crearBebida" tabindex="-1" aria-labelledby="crearBebidaLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
  <div class="modal-content">
      <div class="modal-header">
      <h5 class="modal-title" id="crearBebidaLabel">Crear</h5>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form name="f" action="{{route('bebidas.store')}}" method="POST">
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
            $tipos = DB::table('tipobebidas')->get();
            @endphp
            <div class="col">
            <label for="tipobebida_id" class="col-form-label">Tipo de bebida</label>
            <select name="tipobebida_id" class="form-select form-select-sm" aria-label=".form-select-sm example">
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
<div class="modal fade" id="editarBebida" tabindex="-1" aria-labelledby="editarBebidaLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
  <div class="modal-content">
      <div class="modal-header">
      <h5 class="modal-title" id="editarBebidaLabel">Editar</h5>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form name="f" id="editarBebida" action="{{route('bebidas.update','bebida_id')}}" method="POST">
          @csrf
          @method('PUT')
          <div class="col">
              <label for="nombre" class="col-form-label">Nombre</label>
              <input type="text" class="form-control" name="nombre" placeholder="Nombre" id="nombre_edit">
          </div>
          <input type="hidden" name="id" id="bebida_id" value="">
          <div class="col">
            <label for="precio" class="col-form-label">Precio</label>
            <input type="number" class="form-control" name="precio" placeholder="Precio" id="precio_edit" step="any">
         </div>
            @php
                $tipos = DB::table('tipobebidas')->get();
            @endphp
            <div class="col">
                <label for="tipobebida_id" class="col-form-label">Tipo de bebida</label>
                <select name="tipobebida_id" id="tipobebida_id_edit" class="form-select form-select-sm" aria-label=".form-select-sm example">
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
                            - Nombre: indica un nombre identificativo para la bebida. Debe ser único y no tener más de 120 caracteres.
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
                            - Tipo: indica el tipo de bebida. Ambas podrán ir acompañadas de tapas, pero en las bebidas sin tapa se sumará el
                            precio de la bebida y tapa, y en las bebidas con tapa se sumará solamente el de la bebida.
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
                            - Nombre: indica un nombre identificativo para la bebida. Debe ser único y no tener más de 120 caracteres.
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
                            - Tipo: indica el tipo de bebida. Ambas podrán ir acompañadas de tapas, pero en las bebidas sin tapa se sumará el
                            precio de la bebida y tapa, y en las bebidas con tapa se sumará solamente el de la bebida.
                        </div>
                    </div>
                </div>
            </div>

            <div class="card login-card mt-1">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-body">
                            - Disponibilidad: indica su disponibilidad. Si no se encuentra disponible, no se podrán realizar pedidos nuevos con esta bebida
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
    <script src="{{ asset('js/edit_bebida.js') }}"></script>
    <script src="{{ asset('js/validate_bebida.js') }}"></script>
@endsection
