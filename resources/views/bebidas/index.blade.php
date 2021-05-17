@extends('main')
@section('title')
Todas los platos
@endsection
@section('content')
<div class="row mt-4">
  <div class="col-lg-4">
   <button data-bs-toggle="modal" data-bs-target="#crearBebida" type="button" class="btn btn-success">Crear</a>
  </div>
</div>
<div class="row mt-2">
  <div class="col-md-12">
      <table class="table table-striped table-hover">
          <thead>
              <tr>
              <th scope="col">Nombre</th>
              <th scope="col">Precio</th>
              <th scope="col">Tipo</th>
              <th scope="col"></th>
              </tr>
          </thead>
          <tbody>
            @foreach ($bebidas as $bebida)
            <tr>
              <td>{{$bebida->nombre}}</td>
              <td>{{$bebida->precio}}</td>
              <td>
                @php
                    $tipo = '\App\Models\Tipobebida'::find($bebida->tipobebida_id);
                @endphp
                {{$tipo->nombre}}
              </td>
              <td>
                <div class="row">
                  <div class="col-md-6">
                    <button class="btn btn-success" type="button"
                    data-bebida_id="{{$bebida->id}}" data-nombre="{{$bebida->nombre}}" data-precio="{{$bebida->precio}}"
                    data-tipobebida_id="{{$bebida->tipobebida_id}}" data-bs-toggle="modal" data-bs-target="#editarBebida">Editar</button>
                  </div>
                  <div class="col-md-6">
                    <form name="f" action="{{route('bebidas.destroy', $bebida)}}"  method="POST">
                      @csrf
                      @method('DELETE')
                      <button class="btn btn-danger" type="submit">Borrar</button>
                    </form>    
                  </div>
                </div>
              </div>
              </td>
            </tr>
            @endforeach
          </tbody>
      </table>
  </div>
</div>

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
          <div class="row mt-4">
              @php
                  $tipos = DB::table('tipobebidas')->get();
              @endphp
              <div class="col">
                  <select name="tipobebida_id" class="form-select form-select-sm" aria-label=".form-select-sm example">
                      @foreach ($tipos as $item)
                          <option value="{{$item->id}}">{{$item->nombre}}</option>
                      @endforeach
                  </select>
              </div>
          </div>
          <div class="row mt-4">
              <div class="col">
                  <button class="btn btn-success" type="submit"><i class="fa fa-plus"></i>Crear</button>
                  <button class="btn btn-warning" type="reset"><i class="fa fa-brush"></i> Limpiar</button>
                  <a href="{{route('bebidas.index')}}" class="btn btn-primary"><i class="fa fa-house-user"></i> Volver</a>
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
          <div class="row mt-4">
              @php
                  $tipos = DB::table('tipobebidas')->get();
              @endphp
              <div class="col">
                  <select name="tipobebida_id" id="tipobebida_id_edit" class="form-select form-select-sm" aria-label=".form-select-sm example">
                      @foreach ($tipos as $item)
                          <option value="{{$item->id}}">{{$item->nombre}}</option>
                      @endforeach
                  </select>
              </div>
          </div>
          <div class="row mt-4">
              <div class="col">
                  <button class="btn btn-success" type="submit"><i class="fa fa-plus"></i>Editar</button>
                  <button class="btn btn-warning" type="reset"><i class="fa fa-brush"></i> Limpiar</button>
                  <a href="{{route('bebidas.index')}}" class="btn btn-primary"><i class="fa fa-house-user"></i> Volver</a>
              </div>
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