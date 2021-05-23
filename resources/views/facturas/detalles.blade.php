@extends('main')
@section('content')
@php
    $todosPedidos=$factura->pedidos;
    $pedidos = $todosPedidos->where('estado_id',4)->all();
    $estados = DB::table('estados')->get();
    $tapas = DB::table('tapas')->where('user_id', auth()->user()->id)->get();
    $bebidas = DB::table('bebidas')->where('user_id', auth()->user()->id)->get();
@endphp
<div class="col s12 mt-4">
    <a id="listb" href="{{url()->previous()}}">
      <span class="back-to-index">
        <i class="material-icons back-arrow">keyboard_backspace</i>
        <span>Volver</span>
      </span>
    </a>
</div>
@if (count($pedidos)==0)
<div class="row mt-4">
    No hay pedidos
</div>
@else
<div class="d-flex justify-content-end mb-4">
    <a class="btn btn-primary" href="{{ URL::to('download-pdf',$factura) }}">Imprimir factura</a>
</div>
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
                <input type="hidden" name="pedido_id" id="pedido_id">
                <div class="col">
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
                        <select name="tapa_id" id="tapa_id_edit" class="form-select form-select-md" aria-label=".form-select-md example">
                            <option>Selecciona un plato</option>
                            @foreach ($tapas as $item)
                                <option value="{{$item->id}}"
                                    @if ($tapa!=null && $item->id==$tapa->id)
                                    selected
                                    @endif>
                                    {{$item->nombre}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col">
                        <select name="bebida_id" id="bebida_id_edit" class="form-select form-select-md" aria-label=".form-select-md example">
                            <option>Selecciona una bebida</option>
                            @foreach ($bebidas as $item)
                                <option value="{{$item->id}}"
                                    @if ($bebida!=null && $item->id==$bebida->id)
                                        selected
                                    @endif>
                                    {{$item->nombre}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col">
                        <input type="number" class="form-control" id="cantidad_edit" name="cantidad">
                    </div>
                </div>
                <input type="hidden" name="mesa_id" id="mesa_id_edit">
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
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
@endsection
@section('js')
    <script src="{{ asset('js/edit_pedido.js') }}"></script>
    <script src="{{ asset('js/validate_pedido.js') }}"></script>
@endsection
