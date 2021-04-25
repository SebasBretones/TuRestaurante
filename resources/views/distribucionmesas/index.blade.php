@extends('main')
@section('title')
Distribuciones de mesas
@endsection
@section('content')

{{$distribuciones->links()}}

<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3 centrado">
    @foreach ($distribuciones as $distribucion)
    <div class="col">
        <div class="card shadow-sm">
        <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"/><text x="45%" y="50%" fill="#eceeef" dy=".3em">{{$distribucion->nombre}}</text></svg>

        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
            <div class="btn-group">
                <a href="{{route('distribucionmesas.show', $distribucion)}}" type="button" class="btn btn-sm btn-outline-secondary">View</a>
                <a type="button" class="btn btn-sm btn-outline-secondary">Edit</a>
            </div>
            @php
            $numMesas = DB::table('mesas')
                ->where('distribucion_id', $distribucion->id)
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
