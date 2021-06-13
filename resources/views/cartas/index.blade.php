@extends('main')

@section('content')

<div class="card login-card mtg">
    <div class="row no-gutters"">
        <div class="col-md-12">
            <div class="card-body text-center">
                Escanea este código qr para acceder a la carta
            </div>
        </div>
    </div>
</div>

<div class="text-center mt-5">
    {!!QrCode::size(200)->generate( URL::to('show',$user) ) !!}
</div>
@endsection

