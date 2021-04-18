@extends('main')
@section('content')
<div class="py-5 text-center">
    <img class="d-block mx-auto mb-4" src="{{asset('img/fondo.jpg')}}" alt="" width="72" height="57">
    <h2>Crea un nuevo tipo de distribución para tu restaurante</h2>
    <p class="lead"></p>
</div>

<div>
    <form class="needs-validation" novalidate>
        <div class="row">
            <div class="col">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" placeholder="" value="" required>
                <div class="invalid-feedback">
                Debe insertar un nombre
            </div>
        </div>
    </form>
</div>
@endsection
