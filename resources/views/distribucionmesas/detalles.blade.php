@extends('main')

@section('title')
  <div class="titulo distribucion-header">
    <div class="container text-center">
      <div class="row">
        <div class="col-lg-12">
          <h1>Mesas</h1>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('content')
@php
    $cont=0;
@endphp

<div class="col mt-4">
    <div class="col-lg-4">
        <button class="btn btn-success me-md-2" type="button" data-bs-toggle="modal" data-bs-target="#crearMesa">Crear</button>
    </div>
</div>

@if (count($mesas)==0)
    <p>No hay mesas</p>
    <div id="editarMesa"></div>
@else
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3 centrado">
        @foreach ($mesas as $mesa)
        @php
        $cont=$cont+1;
        @endphp
        <div class="col animate__animated animate__zoomIn">
            <div class="card shadow-sm">
                <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"/><text x="50%" y="50%" dominant-baseline="middle" text-anchor="middle" fill="#eceeef" dy=".3em">Mesa {{$mesa->id}}</text></svg>
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="btn-group qMesa" data-mesa="{{$mesa->id}}">
                            @php
                                $factura= '\App\Models\Factura'::find($mesa->factura_id)
                            @endphp
                            <a href="{{route('facturas.show',$factura)}}" type="button" class="btn btn-sm btn-outline-secondary">Factura</a>
                            <a class="btn btn-sm btn-outline-secondary edit-mesa-button" role="button"
                            data-mesa_id="{{$mesa->id}}" data-num_asientos="{{$mesa->num_asientos}}" data-ocupada="{{$mesa->ocupada}}"
                            data-distribucion_id="{{$mesa->distribucion_id}}"  data-bs-toggle="modal" data-bs-target="#editarMesa">Editar</a>
                            <form name="borrar" action="{{route('mesas.destroy',$mesa)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">Borrar</a>
                            </form>
                        </div>
                        @php
                            $numMesas = DB::table('mesas')
                                ->where('distribucion_id', $distribucionmesa->id)
                                ->count();
                        @endphp
                        @if ($mesa->ocupada)
                            <div>
                                <a class="btn btn-sm btn-outline-secondary" role="button" href="{{route('pedidos.create',$mesa)}}">Pedidos</a>
                            </div>
                        @else
                            <div>
                                <span class="duracionSalto badge bg-success">Libre</span>
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <!--Modal editar-->
    <div class="modal fade" id="editarMesa" tabindex="-1" aria-labelledby="editarMesaLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="editarMesaLabel">Editar</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form name="f" action="{{route('mesas.update','mesa_id')}}" class="needs-validation row g-3" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="col">
                        <label for="num_asientos" class="col-form-label">Número de asientos</label>
                        <input type="number" class="form-control" name="num_asientos" placeholder="Número de asientos" id="num_asientos" value="">
                    </div>
                    <div class="row mt-4">
                        <div class="col">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="ocupada" id="ocupada" value="0">
                                <label class="form-check-label" for="ocupada">
                                Sin ocupar
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="ocupada" id="ocupada2" value="1">
                                <label class="form-check-label" for="ocupada2">
                                Ocupada
                                </label>
                            </div>
                        </div>
                    </div>
                    @php
                        $distribucions = DB::table('distribucions')->get();
                    @endphp
                    <div class="col">
                        <label for="distribucion_id" class="col-form-label">Distribución</label>
                        <select name="distribucion_id" id="distribucion_id" class="form-select form-select-sm" aria-label=".form-select-sm example">
                            @foreach ($distribucions as $item)
                                <option value="{{$item->id}}"
                                    @if(($item->id)==($mesa->distribucion_id)) selected @endif>
                                {{$item->nombre}}</option>
                            @endforeach
                        </select>
                    </div>
                    <input type="hidden" id="mesa_id" name="mesa_id">
                    <div class="modal-footer">
                        <button class="btn btn-warning" type="reset">Resetear</button>
                        <button type="submit" class="btn btn-success">Editar</button>
                    </div>
                </form>
            </div>
        </div>
        </div>
    </div>
@endif


@include('partials._paginator', ['array' => $mesas])

<!--Modal crear-->
<div class="modal fade" id="crearMesa" tabindex="-1" aria-labelledby="crearMesaLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="crearMesaLabel">Crear</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form name="f" action="{{route('mesas.store')}}" class="needs-validation row g-3" method="POST">
                @csrf
                <div class="col">
                    <label for="num_asientos" class="col-form-label">Número de asientos</label>
                    <input type="number" class="form-control" name="num_asientos" placeholder="Número de asientos" value="" id="num_asientos_crear">
                </div>
                <div class="row mt-4">
                    <div class="col">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="ocupada" id="ocupada_crear" value="0" checked>
                            <label class="form-check-label" for="ocupada">
                            Sin ocupar
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="ocupada" id="ocupada2_crear" value="1">
                            <label class="form-check-label" for="ocupada2">
                            Ocupada
                            </label>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="distribucion_id" value="{{$distribucionmesa->id}}">
                <div class="modal-footer">
                    <button class="btn btn-warning" type="reset">Resetear</button>
                    <button type="submit" class="btn btn-success">Crear</button>
                </div>
            </form>
        </div>
      </div>
    </div>
</div>




@endsection
@section('js')
    <script src="{{ asset('js/edit_mesa.js') }}"></script>
    <script src="{{ asset('js/validate_mesa.js') }}"></script>
@endsection
