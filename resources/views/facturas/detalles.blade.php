@extends('main')
@section('content')
@php
    $todosPedidos=$factura->pedidos;
    $pedidos = $todosPedidos->where('estado_id',4)->all();
    if(count($pedidos)!=0)
        $mesa = '\App\Models\Mesa'::find($pedidos[array_key_first($pedidos)]->mesa_id);
    $estados = DB::table('estados')->get();
    $tapas = DB::table('tapas')->where('user_id', auth()->user()->id)->get();
    $bebidas = DB::table('bebidas')->where('user_id', auth()->user()->id)->get();
@endphp
<div class="row justify-content-between mt-4">
    @if (count($pedidos)!=0)
    <div class="col-4 enlaces left">
        <a id="listb" href="{{route('distribucionmesas.show', $mesa ->distribucion_id)}}">
            <span class="back-to-index">
                <i class="material-icons back-arrow">keyboard_backspace</i>
                <span>Lista de mesas</span>
            </span>
        </a>
    </div>
    <div class="col-4 enlaces right">
        <a id="listb" href="{{route('pedidos.create', [$mesa, $mesa ->distribucion_id])}}">
            <span>Lista de pedidos</span>
            <span class="material-icons">
                arrow_forward
            </span>
        </a>
    </div>
    @endif
</div>
@if (count($pedidos)==0)
<div class="row mt-4">
    No hay pedidos entregados
</div>
@else
<div class="row justify-content-between mt-4">
    <div class="left col-2">
        <button class="btn" type="button" data-bs-toggle="modal" data-bs-target="#info">
            <span class="material-icons">info</span>
        </button>
    </div>
    <div class="right col-10">
        <a class="btn btn-primary" href="{{route('pedidos.recalcular',$factura) }}">Recalcular factura</a>
        <a class="btn btn-primary" href="{{ URL::to('download-pdf',$factura) }}">Imprimir factura</a>
    </div>
</div>
<div class="row mt-4">
    <div class="col-md-12">
        <div class="table100 ver3 res m-b-110">
            <table data-vertable="ver3">
                <thead>
                    <tr class="row100 head">
                        <th class="pColumn1">Nº Pedido</th>
                        <th class="pColumn3">Precio</th>
                        <th class="pColumn4">Tapa</th>
                        <th class="pColumn5">Bebida</th>
                        <th class="pColumn6">Cantidad</th>
                        <th class="pColumn7"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pedidos as $ped)
                        @php
                            $pedido= '\App\Models\Pedido'::find($ped->id)
                        @endphp
                        <tr class="row100">
                            <td class="pColumn1">{{$ped->id}}</th>
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
                            <input type="hidden" name='mesa_id' value="{{$ped->mesa_id}}">
                            <td class="pColumn7">
                                <div class="btn-group">
                                    <a class="btn btn-success" role="button"
                                    data-id="{{$ped->id}}" data-estado_id="{{$ped->estado_id}}"
                                    data-tapa_id="{{$ped->tapa_id}}" data-bebida_id="{{$ped->bebida_id}}" data-cantidad="{{$ped->cantidad}}"
                                    data-mesa_id="{{$ped->mesa_id}}" data-bs-toggle="modal" data-bs-target="#editarPedido">Editar</a>
                                    <div class="ms-2">
                                        <form name="f" action="{{route('pedidos.destroy', $ped)}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                          <button class="btn btn-danger" type="submit" onclick="return confirm('¿Estás seguro de que quieres eliminar el pedido nº {{$ped->id}}?')">Borrar</button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    <tr>
                        <td class="pColumn1"> </td>
                        <td class="pColumn3">{{$factura->total_factura}} €</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

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
                <input type="hidden" name="mesa_id" id="mesa_id_edit">
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

                                    @if ($tapa!=null && $item->id==$tapa->id)
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
                <div class="modal-footer">
                    <button class="btn btn-warning" type="reset">Resetear</button>
                    <button type="submit" class="btn btn-primary">Editar</button>
                </div>
            </form>
        </div>
    </div>
    </div>
</div>
    <div class="row mt-4 center">
        <div class="col-md-12">
            <form name="f" action="{{route('facturas.update',$factura)}}" method="POST">
                @method("PUT")
                @csrf
                <button type="submit" onclick="return confirm('¿Estás seguro? Los pedidos y la factura se eliminarán')" class="btn btn-danger">
                    Pagar factura
                </button>
            </form>
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
                            <p>- Factura: desde la siguiente tabla se podrán editar todos los pedidos.</p>
                            <p>Si cambia a cualquier otro estado, el pedido desaparecerá de esta lista y pasará a los pedidos.</p>
                            <p>Si algún plato o bebida del pedido dejan de estar disponibles, se podrán cambiar a otros que estén disponibles o dejarlos como están.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card login-card mt-1">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-body">
                            <p>
                                - Recalcular factura: el botón recalcular factura juntará los pedidos que contengan los mismos platos y/o bebidas.
                                Además, juntará los pedidos que contengan solo tapas con los que tengan solo bebidas que puedan incluir tapas y
                                recalculará el precio que se deba descontar al juntarlos.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card login-card mt-1">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-body">
                            <p>
                                - Imprimir factura: el botón imprimir factura descargará la factura en un fichero PDF con un formato similar al de la tabla.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card login-card mt-1">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-body">
                            <p>- Pagar factura: este botón eliminará todos los pedidos de la mesa actual, incluso los no entregados.</p>
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
