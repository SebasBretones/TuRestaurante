@extends('main')
@section('title')
Editar mesa {{$mesa->id}}
@endsection
@section('content')
<div class="mt-3 mx-auto p-2 w-4/5" id="formCorto">
    <form name="f" action="{{route('mesas.update',$mesa)}}" method="POST">
        @csrf
        @method('PUT')
        <div class="col">
            <label for="num_asientos" class="col-form-label">Número de asientos</label>
            <input type="number" class="form-control" name="num_asientos" placeholder="Número de asientos" id="num_asientos" value={{$mesa->num_asientos}} required>
        </div>
        <div class="row mt-4">
            <div class="col">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="ocupada" id="flexRadioDefault1" @if (!$mesa->ocupada)
                    checked
                    @endif value="0">
                    <label class="form-check-label" for="flexRadioDefault1">
                    Sin ocupar
                    </label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="ocupada" id="flexRadioDefault2"  @if ($mesa->ocupada)
                    checked
                    @endif value="1">
                    <label class="form-check-label" for="flexRadioDefault2">
                    Ocupada
                    </label>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            @php
                $distribucions = DB::table('distribucions')->get();
            @endphp
            <div class="col">
                <select name="distribucion_id" class="form-select form-select-sm" aria-label=".form-select-sm example">
                    @foreach ($distribucions as $item)
                        <option value="{{$item->id}}"
                            @if(($item->id)==($mesa->distribucion_id)) selected @endif>
                        {{$item->nombre}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col">
                <button class="btn btn-success" type="submit"><i class="fa fa-plus"></i>Editar</button>
                <button class="btn btn-warning" type="reset"><i class="fa fa-brush"></i> Limpiar</button>
                <a href="{{route('distribucionmesas.show',$mesa->distribucion_id)}}" class="btn btn-primary"><i class="fa fa-house-user"></i> Volver</a>
            </div>
        </div>
    </form>
</div>
@endsection


