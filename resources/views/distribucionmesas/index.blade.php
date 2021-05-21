@extends('main')
@section('title')
Distribuciones de mesas
@endsection
@section('content')

<div class="row mt-4">
    <div class="col-lg-4">
        <button class="btn btn-success" type="button" data-bs-toggle="modal" data-bs-target="#crearDistribucion">Crear</button>
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
                        <a type="button" class="btn btn-sm btn-outline-secondary" data-distribucion_id="{{$distribucionmesa->id}}" data-nombre="{{$distribucionmesa->nombre}}"
                            data-bs-toggle="modal" data-bs-target="#editarDistribucion">Editar</a>
                        <form name="f" action="{{route('distribucionmesas.destroy', $distribucionmesa)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger">Borrar</button>
                        </form>
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

@include('partials._paginator', ['array' => $distribuciones])

<!--Modal crear-->
<div class="modal fade" id="crearDistribucion" tabindex="-1" aria-labelledby="crearDistribucionLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="crearDistribucionLabel">Crear</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form name="f" action="{{route('distribucionmesas.store')}}" class="needs-validation row g-3" method="POST">
                @csrf
                <div class="row mt-4">
                    <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre" value="">
                    <div class="invalid-feedback">Debe insertar un nombre</div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Crear</button>
                </div>
            </form>
        </div>
    </div>
    </div>
</div>

<!--Modal editar-->
<div class="modal fade" id="editarDistribucion" tabindex="-1" aria-labelledby="editarDistribucionLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="editarDistribucionLabel">Editar</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form name="f" action="{{route('distribucionmesas.update','distribucion_id')}}" class="needs-validation row g-3" method="POST">
                @csrf
                @method('PUT')
                <div class="row mt-4">
                    <input type="text" class="form-control" name="nombre" id="nombre_edit" placeholder="Nombre" value="">
                    <div class="invalid-feedback">Debe insertar un nombre</div>
                </div>
                <input type="hidden" id="distribucion_id" name="distribucion_id">
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Editar</button>
                </div>
            </form>
        </div>
    </div>
    </div>
</div>
@endsection

@section('js')
    <script src="{{ asset('js/edit_dist.js') }}"></script>
    <script src="{{ asset('js/validate_dist.js') }}"></script>
@endsection