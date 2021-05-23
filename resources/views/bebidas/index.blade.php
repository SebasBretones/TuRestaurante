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

<div class="row mt-4">
  <div class="col-lg-4">
    <button data-bs-toggle="modal" data-bs-target="#crearBebida" type="button" class="btn btn-success">Crear</button></div>
</div>

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
                  data-tipobebida_id="{{$bebida->tipobebida_id}}" data-bs-toggle="modal" data-bs-target="#editarBebida">Editar</button>
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
          <div class="modal-footer">
            <button class="btn btn-warning" type="reset">Resetear</button>
            <button type="submit" class="btn btn-success">Crear</button>
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
          <div class="modal-footer">
            <button class="btn btn-warning" type="reset">Resetear</button>
            <button type="submit" class="btn btn-success">Editar</button>
        </div>
      </form>
      </div>
  </div>
  </div>
</div>

@endsection

@section('js')
    <script src="{{ asset('js/edit_bebida.js') }}"></script>
    <script src="{{ asset('js/validate_bebida.js') }}"></script>
@endsection
