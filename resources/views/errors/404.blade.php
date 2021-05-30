<!DOCTYPE html>
<html lang="en">
@include('partials._head')
<body>
    <div class="row justify-content-center" id="loginc">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">Error 404</div>
                <div class="card-body text-center">
                    {{ __('No hemos encontrado lo que estuvieras buscando') }}
                    <br>
                    <a href="{{route('inicio')}}">Vuelve al inicio</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>


