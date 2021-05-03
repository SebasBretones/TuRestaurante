@extends('main')
@section('title')
Realizar pedido
@endsection
@section('content')
<div class="mt-3 mx-auto p-2 w-4/5">
    <form name="f" action="{{route('pedidos.store',$mesa)}}" method="POST">
        @csrf
        <div class="row mt-4">
            @php
                $tapas = DB::table('tapas')->get();
            @endphp
            <div class="col-md-4">
                <select name="tapa_id" class="form-select form-select-md" aria-label=".form-select-md example">
                    <option selected>Selecciona una tapa</option>
                    @foreach ($tapas as $item)
                    <option value="{{$item->id}}">{{$item->nombre}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <input type="text" class="form-control" id="cantidad" name="cantidad" placeholder="Cantidad">
            </div>
        </div>
        <div class="row mt-4">
            @php
                $estados = DB::table('estados')->get();
            @endphp
            <div class="col">
                <select name="estado_id" class="form-select form-select-sm" aria-label=".form-select-sm example">
                    <option selected>Selecciona un estado</option>
                    @foreach ($estados as $item)
                    <option value="{{$item->id}}">{{$item->nombre}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col">
                <button class="btn btn-success" type="submit"><i class="fa fa-plus"></i>Crear pedido</button>
                <button class="btn btn-warning" type="reset"><i class="fa fa-brush"></i> Limpiar</button>
                <a href="#" class="btn btn-primary"><i class="fa fa-house-user"></i> Volver</a>
            </div>
        </div>
    </form>
</div>
<hr/>
PEDIDOS LISTA
@endsection


