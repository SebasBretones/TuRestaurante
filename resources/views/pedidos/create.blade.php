@extends('main')
@section('content')
@php
    $estados = DB::table('estados')->get();
    $tapas = DB::table('tapas')->orderBy('nombre')->where('user_id', auth()->user()->id)->get();
    $bebidas = DB::table('bebidas')->orderBy('nombre')->where('user_id', auth()->user()->id)->get();
    $pedidos = DB::table('pedidos')->where([
    ['mesa_id',$mesa->id],
    ['estado_id','!=',4],
    ])->paginate(10);

    $pfact = DB::table('pedidos')->where([
    ['mesa_id',$mesa->id],
    ['estado_id', 4],
    ])->get();
@endphp
<div class="row justify-content-between mt-4">
    <div class="col-4 left enlaces">
        <a id="listb" href="{{route('distribucionmesas.show',$mesa->distribucion_id)}}">
            <span class="back-to-index">
                <i class="material-icons back-arrow">keyboard_backspace</i>
                <span>Volver al listado</span>
            </span>
        </a>
    </div>
    @if (count($pfact)!=0)
        <div class="col-4 right enlaces">
            <a id="listb" href="{{route('facturas.show',[$mesa->factura_id, $mesa->distribucion_id])}}">
                <span>Ir a la factura</span>
                <span class="material-icons">
                    arrow_forward
                </span>
            </a>
        </div>
    @endif
</div>

<div class="row mt-3">
    <form name="f" id="crearPedido" action="{{route('pedidos.store')}}" method="POST">
        @csrf
        <div class="row mt-4">
            <div class="col-md-4">
                <select name="tapa_id" id="tapa_id" class="form-select form-select-md" aria-label=".form-select-md example">
                    <option selected>Selecciona un plato</option>
                    @foreach ($tapas as $item)
                    <option value="{{$item->id}}|{{$item->tipotapa_id}}" @if ($item->disponible == 0) disabled @endif>
                        @php
                            $tipo = '\App\Models\Tipotapa'::find($item->tipotapa_id);
                        @endphp
                        {{$item->nombre}} - {{$tipo->nombre}} - {{$item->precio}}€
                    </option>
                    @endforeach
                </select>
            </div>
            <input type="hidden" name="tapas" id="tapas" value="{{$tapas}}">
            <div class="col-md-4">
                <select name="bebida_id" id="bebida_id" class="form-select form-select-md" aria-label=".form-select-md example">
                    <option selected>Selecciona una bebida</option>
                    @foreach ($bebidas as $item)
                    <option value="{{$item->id}}" @if ($item->disponible == 0) disabled @endif>
                        @php
                            $tipo = '\App\Models\Tipobebida'::find($item->tipobebida_id);
                        @endphp
                        {{$item->nombre}} - {{$tipo->nombre}} - {{$item->precio}}€
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <input type="number" class="form-control" id="cantidad" name="cantidad" placeholder="Cantidad">
            </div>
            <input type="hidden" name='mesa_id' value="{{$mesa->id}}">
            <input type="hidden" name='estado_id' value="1">
        </div>
        <div class="row mt-4">
            <div class="col">
                <button class="btn" type="button" data-bs-toggle="modal" data-bs-target="#info">
                    <span class="material-icons">info</span>
                </button>
                <button class="btn btn-warning" type="reset">Resetear</button>
                <button class="btn btn-success" type="submit">Realizar pedido</button>
            </div>
        </div>
    </form>
</div>

@if (count($pedidos)!=0)
    <hr/>
    <button class="btn" type="button" data-bs-toggle="modal" data-bs-target="#infoe">
        <span class="material-icons">info</span>
    </button>
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="table100 ver3 res m-b-110">
                <table data-vertable="ver3">
                    <thead>
                        <tr class="row100 head">
                            <th class="pColumn1">Nº Pedido</th>
                            <th class="pColumn2">Estado</th>
                            <th class="pColumn3">Precio</th>
                            <th class="pColumn4">Tapa</th>
                            <th class="pColumn5">Bebida</th>
                            <th class="pColumn6">Cantidad</th>
                            <th class="pColumn7"><a class="btn btn-success" href="{{route('pedidos.entregar',$mesa) }}">Entregar pedidos</a></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pedidos as $ped)
                            @php
                                $pedido= '\App\Models\Pedido'::find($ped->id)
                            @endphp
                            <tr class="row100">
                                <td class="pColumn1">{{$ped->id}}</td>
                                <td class="pColumn2">
                                    @php
                                        $est = '\App\Models\Estado'::find($ped->estado_id)
                                    @endphp
                                    {{$est->nombre}}
                                </td>
                                <td class="pColumn3">{{$ped->total_pedido}} €</td>
                                <td class="pColumn4">
                                    @php
                                        $tapa = DB::table('tapas')->find($ped->tapa_id)
                                    @endphp
                                    @if ($tapa!=null)
                                        {{$tapa->nombre}}
                                    @endif
                                </td>
                                <td class="pColumn5">
                                    @php
                                        $bebida = DB::table('bebidas')->find($ped->bebida_id)
                                    @endphp
                                    @if ($bebida!=null)
                                        {{$bebida->nombre}}
                                    @endif
                                </td>
                                <td class="pColumn6">{{$ped->cantidad}}</td>
                                <input type="hidden" name='mesa_id' value="{{$mesa->id}}">
                                <td class="pColumn7">
                                    <div class="btn-group">
                                        <a class="btn btn-success" role="button"
                                        data-id="{{$ped->id}}" data-estado_id="{{$ped->estado_id}}"
                                        data-tapa_id="{{$ped->tapa_id}}" data-bebida_id="{{$ped->bebida_id}}" data-cantidad="{{$ped->cantidad}}"
                                        data-mesa_id="{{$ped->mesa_id}}" data-bs-toggle="modal" data-bs-target="#editarPedido">Editar</a>
                                        <div class="ms-2">
                                            <form name="d" action="{{route('pedidos.destroy', $pedido)}}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                              <button class="btn btn-danger" type="submit" onclick="return confirm('¿Estás seguro de que quieres eliminar el pedido nº {{$ped->id}}?')">Borrar</button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @include('partials._paginator', ['array' => $pedidos])
    <!--Modal editar-->
    <div class="modal fade" id="editarPedido" tabindex="-1" aria-labelledby="editarPedidoLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="editarPedidoLabel">Editar</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form name="fo" action="{{route('pedidos.update','pedido_id')}}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="pedido_id" id="pedido_id">
                    <div class="col">
                        <label for="estado_id" class="col-form-label">Estado</label>
                        <select name="estado_id" id="estado_id_edit" class="form-select form-select-md" aria-label=".form-select-md example">
                            @foreach ($estados as $item)
                                <option value="{{$item->id}}"
                                    @if ($item->id==$pedido->estado_id)
                                    selected
                                    @endif>
                                {{$item->nombre}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row mt-2">
                        <div class="col">
                            <label for="tapa_id" class="col-form-label">Plato</label>
                            <select name="tapa_id" id="tapa_id_edit" class="form-select form-select-md" aria-label=".form-select-md example">
                                <option>Selecciona un plato</option>
                                @foreach ($tapas as $item)
                                    <option value="{{$item->id}}"
                                        @if ($item->disponible == 0)
                                            disabled
                                        @endif

                                        @if ($tapa != null && $item->id == $tapa->id)
                                        selected
                                        @endif>
                                        @php
                                            $tipo = '\App\Models\Tipotapa'::find($item->tipotapa_id);
                                        @endphp
                                        {{$item->nombre}} - {{$tipo->nombre}} - {{$item->precio}}€
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col">
                            <label for="bebida_id" class="col-form-label">Bebida</label>
                            <select name="bebida_id" id="bebida_id_edit" class="form-select form-select-md" aria-label=".form-select-md example">
                                <option>Selecciona una bebida</option>
                                @foreach ($bebidas as $item)
                                    <option value="{{$item->id}}"
                                        @if ($item->disponible == 0)
                                            disabled
                                        @endif

                                        @if ($bebida!=null && $item->id==$bebida->id)
                                            selected
                                        @endif>
                                        @php
                                            $tipo = '\App\Models\Tipobebida'::find($item->tipobebida_id);
                                        @endphp
                                        {{$item->nombre}} - {{$tipo->nombre}} - {{$item->precio}}€
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col">
                            <label for="cantidad" class="col-form-label">Cantidad</label>
                            <input type="number" class="form-control" id="cantidad_edit" name="cantidad">
                        </div>
                    </div>
                    <input type="hidden" name="mesa_id" id="mesa_id_edit">
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
                           <p>- Pedido: para crear un pedido hay que seleccionar al menos un plato o bebida, además de la cantidad (entre 1 y 30).</p>
                            <p>Si el plato es una ración, el pedido no podrá contener bebida.</p>
                            <p>Si el plato es una tapa, podrá ir acompañado de una bebida de cualquier tipo o ir sola.</p>
                            <p>Si la bebida va acompañada de una tapa, se sumará el precio de ambas si es sin tapa, o solo el precio de la bebida si es con tapa.</p>
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
                            <p>- Lista pedidos: desde la siguiente tabla se podrán editar todos los pedidos.</p>
                            <p>Si cambia el estado a entregado, el pedido desaparecerá de esta lista y pasará a la factura. Aparecerá un
                                enlace para ir a la factura en la esquina superior derecha.
                            </p>
                            <p>Si algún plato o bebida del pedido dejan de estar disponibles, se podrán cambiar a otros que estén disponibles.</p>
                            <p>También se podrán entregar todos los pedidos, incluso los no disponibles, usando el botón <b>ENTREGAR PEDIDOS</b>,
                                siempre y cuando su estado sea Preparación o Finalizado.</p>
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
    <script src="{{ asset('js/edit_pedido.js') }}"></script>
    <script src="{{ asset('js/validate_pedido.js') }}"></script>
@endsection
