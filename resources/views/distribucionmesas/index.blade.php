@extends('main')
@section('title')
Distribuciones de mesas
@endsection
@section('content')

<div class="row">
    {{$distribuciones->links()}}

    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <button class="btn btn-success me-md-2" type="button">Crear</button>
      </div>
</div>


<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3 centrado">
    @foreach ($distribuciones as $distribucionmesa)
    <div class="col animate__animated animate__zoomIn">
        <div class="card shadow-sm">
        <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"/><text x="45%" y="50%" fill="#eceeef" dy=".3em">{{$distribucionmesa->nombre}}</text></svg>

        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
            <div class="btn-group">
                <a href="{{route('distribucionmesas.show',$distribucionmesa)}}" type="button" class="btn btn-sm btn-outline-secondary">Ver</a>
                <a type="button" class="btn btn-sm btn-outline-secondary">Editar</a>
            </div>
            @php
            $numMesas = DB::table('mesas')
                ->where('distribucion_id', $distribucionmesa->id)
                ->count();
            @endphp
            <small class="text-muted">{{$numMesas}} mesas</small>
            </div>
        </div>
        </div>
    </div>
    @endforeach
</div>
@endsection
