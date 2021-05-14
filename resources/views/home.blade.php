@extends('main')
@section('content')
<div class="card login-card">
    <div class="row no-gutters">
        <div class="col-md-12">
            <div class="card-body">
                @if (! auth()->user()->two_factor_secret)
                    You have not enabled 2fa
                    <form method="POST" action="{{ url('user/two-factor-authentication') }}">
                        @csrf
                        <button type="submit" class="btn btn-primary">
                            Enable
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
                    You have now enabled 2fa, plase scan the following QR code into your phone authenticator application
                    {{!! auth()->user()->twoFactorQrCodeSvg() !!}}
                    <p>Please store these recovery codes in a secure location</p>
                    @foreach (json_decode(decrypt(auth()->user()->two_factor_recovery_codes, true)) as $code)
                        {{trim($code)}}<br>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
