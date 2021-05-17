@extends('main')
@section('title')
Pedidos mesa {{$mesa->id}}
@endsection
@section('content')
<div class="mt-3 mx-auto p-2 w-4/5">
    <form name="f" id="editarPedido" action="{{route('pedidos.store')}}" method="POST">
        @csrf
        <div class="row mt-4">
            @php
                $tapas = DB::table('tapas')->get();
                $bebidas = DB::table('bebidas')->get();
            @endphp
            <div class="col-md-4">
                <select name="tapa_id" id="tapa_id" class="form-select form-select-md" aria-label=".form-select-md example">
                    <option selected>Selecciona una tapa o ración</option>
                    @foreach ($tapas as $item)
                    <option value="{{$item->id}}|{{$item->tipotapa_id}}">{{$item->nombre}}</option>
                    @endforeach
                </select>
            </div>
            <input type="hidden" name="tapas" id="tapas" value="{{$tapas}}">
            <div class="col-md-4">
                <select name="bebida_id" id="bebida_id" class="form-select form-select-md" aria-label=".form-select-md example">
                    <option selected>Selecciona una bebida</option>
                    @foreach ($bebidas as $item)
                    <option value="{{$item->id}}">{{$item->nombre}}</option>
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
                <button class="btn btn-success" type="submit"><i class="fa fa-plus"></i>Crear pedido</button>
                <button class="btn btn-warning" type="reset"><i class="fa fa-brush"></i> Limpiar</button>
                <a href="{{route('distribucionmesas.show',$mesa->distribucion_id)}}" class="btn btn-primary"><i class="fa fa-house-user"></i> Volver</a>
            </div>
        </div>
    </form>
</div>

@php
$pedidos = DB::table('pedidos')->where('mesa_id',$mesa->id)->get();
@endphp
@if (count($pedidos)!=0)   
    <hr/>
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
                    @if ($ped->estado_id!=4)
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
                                        $tapa = DB::table('tapas')->find($ped->tapa_id)
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
                                    <input type="hidden" name='mesa_id' value="{{$mesa->id}}">
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
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endif
@endsection

@section('js')
    <script src="{{ asset('js/validate_pedido.js') }}"></script>
@endsection

