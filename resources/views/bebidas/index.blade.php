@extends('main')
@section('title')
Todas los platos
@endsection
@section('content')
<div class="row mt-4">
  <div class="col-lg-4">
    <a href="{{route('bebidas.create')}}" class="btn btn-success">Crear</a>
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
                <div class="col-s6" ><a href="{{route('bebidas.edit',$bebida)}}">Editar</a></div>
                <form name="f" action="{{route('bebidas.destroy', $bebida)}}"  method="POST">
                  @csrf
                  @method('DELETE')
                  <div class="col-s6" ><button type="Submit">Borrar</a></div>         
                </form>    
              </td>
            </tr>
            @endforeach
          </tbody>
      </table>
  </div>
</div>
@endsection