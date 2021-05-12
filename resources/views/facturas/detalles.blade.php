@extends('main')
@section('title')
Factura {{$factura->id}}
@endsection
@section('content')
@php
    $pedidos=$factura->pedidos;
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
                    <th scope="col">Cantidad</th>
                    <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pedidos as $ped)
                    @if ($ped->estado_id==4)
                        @php
                        $pedido= '\App\Models\Pedido'::find($ped->id)
                        @endphp
                        <form name="f" action="{{route('pedidos.update',$pedido)}}" method="POST">
                            @csrf
                            @method('PUT')
                                <tr>
                                    <th scope="row">{{$ped->id}}</th>
                                    <td>
                                        @php
                                        $estados = DB::table('estados')->get();
                                        @endphp
                                        <select name="estado_id" class="form-select form-select-md" aria-label=".form-select-md example">
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
                                        $tapa = DB::table('tapas')->find($ped->tapa_id)
                                        @endphp
                                        {{$tapa->nombre}}
                                    </td>
                                    <td>
                                        <input type="number" class="form-control" id="cantidad" name="cantidad" value={{$ped->cantidad}}>
                                    </td>
                                    <td>
                                        <button class="btn btn-success" type="submit"><i class="fa fa-plus"></i>Actualizar pedido</button>
                                        <button class="btn btn-warning" type="reset"><i class="fa fa-brush"></i>Resetear</button>
                                    </td>
                                </tr>
                            </form>
                        @endif
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
