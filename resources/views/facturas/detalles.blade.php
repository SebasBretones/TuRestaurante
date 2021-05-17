@extends('main')
@section('title')
Factura {{$factura->id}}
@endsection
@section('content')
@php
    $todosPedidos=$factura->pedidos;
    $pedidos = $todosPedidos->where('estado_id',4)->all();

@endphp
@if (count($pedidos)==0)
    No hay pedidos
@else   
    <div class="row mt-4">
        <div class="col-md-12">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                    <th scope="col">Nº Pedido</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Precio</th>
                    <th scope="col">Tapa</th>
                    <th scope="col">Bebida</th>
                    <th scope="col">Cantidad</th>
                    <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pedidos as $ped)
                        @php
                        $pedido= '\App\Models\Pedido'::find($ped->id)
                        @endphp
                        <form name="fo" id="editarPedido" action="{{route('pedidos.update',$pedido)}}" method="POST">
                            @csrf
                            @method('PUT')
                                <tr>
                                    <th scope="row">{{$ped->id}}</th>
                                    <td>
                                        @php
                                        $estados = DB::table('estados')->get();
                                        @endphp
                                        <select name="estado_id" id="estado_id" class="form-select form-select-md" aria-label=".form-select-md example">
                                            @foreach ($estados as $item)
                                                <option value="{{$item->id}}"
                                                    @if ($item->id==$pedido->estado_id)
                                                    selected
                                                    @endif>
                                                {{$item->nombre}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>{{$ped->total_pedido}}</td>
                                    <td>
                                        @php
                                        $tapa = DB::table('tapas')->find($ped->tapa_id);
                                        $tapas = DB::table('tapas')->get();
                                        $bebidas = DB::table('bebidas')->get();
                                        @endphp
                                        <select name="tapa_id" id="tapa_id" class="form-select form-select-md" aria-label=".form-select-md example">
                                            <option>Selecciona una tapa o ración</option>
                                            @foreach ($tapas as $item)
                                                <option value="{{$item->id}}|{{$item->tipotapa_id}}"
                                                    @if ($tapa!=null && $item->id==$tapa->id)
                                                    selected
                                                    @endif>
                                                {{$item->nombre}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        @php
                                        $bebida = DB::table('bebidas')->find($ped->bebida_id)
                                        @endphp
                                        <select name="bebida_id" id="bebida_id" class="form-select form-select-md" aria-label=".form-select-md example">
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
                                    </td>
                                    <td>
                                        <input type="number" class="form-control" id="cantidad" name="cantidad" value={{$ped->cantidad}}>
                                    </td>
                                    <input type="hidden" name='mesa_id' value="{{$pedido->mesa_id}}">
                                    <td>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <button class="btn btn-success" type="submit"><i class="fa fa-plus"></i>Actualizar</button>
                                            </div>
                                            <div class="col-lg-6">
                                            <button class="btn btn-warning" type="reset"><i class="fa fa-brush"></i>Resetear</button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </form>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="row mt-4 center">
        <div class="col-md-12">
            <form name="f" action="{{route('facturas.update',$factura)}}" method="POST">
                @method("PUT")
                @csrf
                <button type="submit" onclick="return confirm('¿Estás seguro? Los pedidos y la factura se eliminarán')" class="btn btn-warning">
                    Pagar factura
                </button>
            </form>
        </div>
    </div>
@endif    
@endsection
@section('js')
    <script src="{{ asset('js/validate_pedido.js') }}"></script>
@endsection