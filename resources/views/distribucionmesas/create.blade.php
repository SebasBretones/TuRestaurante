@extends('main')

@section('title')
Crea un nuevo tipo de distribución para tu restaurante
@endsection

@section('content')
@if ($errors->any())
    <div class="alert alert-danger my-3 p-2">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div>
    <form name="f" action="{{route('distribucionmesas.store')}}" class="needs-validation row g-3" method="POST">
        @csrf
        <div class="row">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" name="nombre" id="nombre" placeholder="" value="" required>
            <div class="invalid-feedback">Debe insertar un nombre</div>
        </div>

        <hr class="my-4">

        <div class="col-auto">
            <button class="btn btn-primary btn-lg" type="submit">Crear</button>
        </div>

        <div class="col-auto">
            <button class="btn btn-danger btn-lg me-2" type="reset">Limpiar</button>
        </div>
    </form>
</div>
@endsection
