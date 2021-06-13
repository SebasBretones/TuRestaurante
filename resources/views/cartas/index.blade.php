@extends('main')

@section('content')

<div class="card login-card mtg">
    <div class="row no-gutters"">
        <div class="col-md-12">
            <div class="card-body text-center">
                Escanea este código qr para acceder a la carta
                <div class="alert alert-success alert-dismissible fade show bottomf text-center" role="alert">
                    <strong>¡Comienza pulsando el botón de crear!</strong>
                    <button type="button" class="btn-close btn-close" aria-label="Close" data-dismiss="alert"></button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="text-center mt-5">
    {!!QrCode::size(200)->generate( URL::to('show',$user) ) !!}
</div>
@endsection

