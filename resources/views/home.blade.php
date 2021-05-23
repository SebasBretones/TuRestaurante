@extends('main')
@section('content')
<div class="card login-card" id="mtg">
    <div class="row no-gutters"">
        <div class="col-md-12">
            <div class="card-body">
                @if (! auth()->user()->two_factor_secret)
                    No ha activado la autenticación en dos pasos
                    <form method="POST" action="{{ url('user/two-factor-authentication') }}">
                        @csrf
                        <button type="submit" class="btn btn-primary">
                            Activar
                        </button>
                    </form>
                @else
                    You have 2fa enabled
                    <form method="POST" action="{{ url('user/two-factor-authentication') }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-primary">
                            Disable
                        </button>
                    </form>
                @endif


                @if(session('status') == 'two-factor-authentication-enabled')
                    Ha activado la autenticación en dos pasos, por favor, escanee el siguiente código QR
                    {{!! auth()->user()->twoFactorQrCodeSvg() !!}}
                    <p>Por favor, guarde estos códigos de recuperación en una localización segura</p>
                    @foreach (json_decode(decrypt(auth()->user()->two_factor_recovery_codes, true)) as $code)
                        {{trim($code)}}<br>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
