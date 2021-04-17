@extends('partials.bVacio')
@section('body')
@extends('partials.navigation')
<div class="jumbotron center mt-5">
    <h1>Bienvenido a TU RESTAURANTE</h1>
    <h2>La mejor aplicación para gestionar tu restaurante!</h2>
    <p><a href="#" class= "btn btn-danger btn-lg btn-personalizado" >Registrate para la app!</a></p>
</div>

<div class="row mt-5">
    <div class="col-lg-4">
        <h2>Safari bug warning!</h2>
        <p class="text-danger">As of v9.1.2, Safari exhibits a bug in which resizing your browser horizontally causes rendering errors in the justified nav that are cleared upon refreshing.</p>
        <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
        <p><a class="btn btn-primary btn-personalizado" href="#" role="button">View details &raquo;</a></p>
    </div>
    <div class="col-lg-4">
        <h2>Heading</h2>
        <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
        <p><a class="btn btn-primary btn-personalizado" href="#" role="button">View details &raquo;</a></p>
    </div>
    <div class="col-lg-4">
        <h2>Heading</h2>
        <p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa.</p>
        <p><a class="btn btn-primary btn-personalizado" href="#" role="button">View details &raquo;</a></p>
    </div>
</div>
@endsection
