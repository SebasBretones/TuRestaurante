@extends('main')
@section('title')
Crear bebida
@endsection
@section('content')
<div class="mt-3 mx-auto p-2 w-4/5" id="formCorto">
  <form name="f" action="{{route('bebidas.store')}}" method="POST">
      @csrf
      <div class="col">
          <label for="nombre" class="col-form-label">Nombre</label>
          <input type="text" class="form-control" name="nombre" placeholder="Nombre" id="nombre" required>
      </div>
      <div class="col">
        <label for="precio" class="col-form-label">Precio</label>
        <input type="number" class="form-control" name="precio" placeholder="Precio" id="nombre" step="any" required>
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
@endsection