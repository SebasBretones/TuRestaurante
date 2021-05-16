@extends('main')
@section('title')
Todas los platos
@endsection
@section('content')
<div class="row mt-4">
  <div class="col-lg-4">
   <button data-bs-toggle="modal" data-bs-target="#crearTapa" type="button" class="btn btn-success">Crear</a>
  </div>
</div>
<div class="row mt-4">
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
            @foreach ($tapas as $tapa)
            <tr>
              <td>{{$tapa->nombre}}</td>
              <td>{{$tapa->precio}}</td>
              <td>
                @php
                    $tipo = '\App\Models\Tipotapa'::find($tapa->tipotapa_id);
                @endphp
                {{$tipo->nombre}}
              </td>
              <td>
                <div class="row">
                  <div class="col-md-6">
                    <button class="btn btn-success" type="button"
                    data-tapa_id="{{$tapa->id}}" data-nombre="{{$tapa->nombre}}" data-precio="{{$tapa->precio}}"
                    data-tipotapa_id="{{$tapa->tipotapa_id}}" data-bs-toggle="modal" data-bs-target="#editarTapa">Editar</button>
                  </div>
                  <div class="col-md-6">
                    <form name="f" action="{{route('tapas.destroy', $tapa)}}"  method="POST">
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
            <input type="number" class="form-control" name="precio" placeholder="Precio" id="nombre" step="any">
         </div>
          <div class="row mt-4">
              @php
                  $tipos = DB::table('tipotapas')->get();
              @endphp
              <div class="col">
                  <select name="tipotapa_id" class="form-select form-select-sm" aria-label=".form-select-sm example">
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
                  <a href="{{route('tapas.index')}}" class="btn btn-primary"><i class="fa fa-house-user"></i> Volver</a>
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
        <form name="f" idaction="{{route('tapas.update','tapa_id')}}" method="POST">
          @csrf
          @method('PUT')
          <div class="col">
              <label for="nombre" class="col-form-label">Nombre</label>
              <input type="text" class="form-control" name="nombre" placeholder="Nombre" id="nombre_edit">
          </div>
          <div class="col">
            <label for="precio" class="col-form-label">Precio</label>
            <input type="number" class="form-control" name="precio" placeholder="Precio" id="precio_edit" step="any">
         </div>
          <div class="row mt-4">
              @php
                  $tipos = DB::table('tipotapas')->get();
              @endphp
              <div class="col">
                  <select name="tipotapa_id" id="tipotapa_id_edit" class="form-select form-select-sm" aria-label=".form-select-sm example">
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
                  <a href="{{route('tapas.index')}}" class="btn btn-primary"><i class="fa fa-house-user"></i> Volver</a>
              </div>
          </div>
      </form>
      </div>
  </div>
  </div>
</div>

@endsection

@section('js')
    <script src="{{ asset('js/edit_tapa.js') }}"></script>
    <script src="{{ asset('js/validate_tapa.js') }}"></script>
@endsection