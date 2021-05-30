<!DOCTYPE html>
<html lang="en">
@include('partials._head')
<body>
    <div class="row justify-content-center" id="loginc">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">Error 405</div>
                <div class="card-body text-center">
                    {{ __('Acción no permitida') }}
                    <br>
                    <a href="{{route('inicio')}}">Vuelve al inicio</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
