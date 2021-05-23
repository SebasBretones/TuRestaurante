@extends('main')
@section('content')
<div class="row justify-content-center" id="loginc">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">{{ __('Verifica tu correo electrónico') }}</div>

            <div class="card-body">
                @if (session('resent'))
                    <div class="alert alert-success" role="alert">
                        {{ __('Un link de verificación nuevo ha sido mandado a su correo electrónico.') }}
                    </div>
                @endif

                {{ __('Antes de proceder, compruebe que en su correo electrónico tiene un link de verificación.') }}
                {{ __('Si no ha recibido el email') }},
                <form class="d-inline" method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('pulse aquí para pedir otro') }}</button>.
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
