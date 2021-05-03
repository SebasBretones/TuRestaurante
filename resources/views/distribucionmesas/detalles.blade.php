@extends('main')
@section('title')
Mesas de {{$distribucionmesa->nombre}}
@endsection
@section('content')
@php
    $cont=0;
@endphp

<div class="row">
    {{$mesas->links()}}
</div>


<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3 centrado">

    @foreach ($mesas as $mesa)
    @php
    $cont=$cont+1;
    @endphp
    <div class="col animate__animated animate__zoomIn">
        <div class="card shadow-sm">
            <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"/><text x="45%" y="50%" fill="#eceeef" dy=".3em">Mesa {{$mesa->id}}</text></svg>
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group qMesa" data-mesa="{{$mesa->id}}">
                        <a href="{{route('mesas.show',$mesa)}}" type="button" class="btn btn-sm btn-outline-secondary">Ver</a>
                        <a class="btn btn-sm btn-outline-secondary edit-mesa-button" role="button" href="{{route('mesas.edit',$mesa)}}">Editar</a>
                    </div>
                    @php
                    $numMesas = DB::table('mesas')
                        ->where('distribucion_id', $distribucionmesa->id)
                        ->count();
                    @endphp
                    <div class="btn-group">
                        @if ($mesa->ocupada)
                        <a class="btn btn-sm btn-outline-secondary" role="button" href="{{route('pedidos.create',$mesa)}}">Realizar pedido</a>
                        @endif
                        @if ($mesa->ocupada)
                        <span class="badge bg-danger">Ocupada</span>
                        @else
                        <span class="duracionSalto badge bg-success">Libre</span>
                        @endif
                        <!--<div class="col-auto"><small class="text-muted">Mesa {{$cont}}-{{$numMesas}}</small></div>-->
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection
