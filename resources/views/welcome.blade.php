@extends('main')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}" />
@endsection

@section('noContainer')
    <div id="slides" class="cover-slides">
        <ul class="slides-container">
            <li class="text-left">
                <img src="{{asset('img/welcome/slide01.jpg')}}" alt="">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h1 class="m-b-20"><strong>Bienvenidos a <br> Tu Restaurante</strong></h1>
                            <p class="m-b-40">Gestiona tu restaurante de la manera<br>
                            más cómoda y fácil.</p>
                            @if (!auth()->user())
                                <p><a class="btn btn-lg btn-circle btn-outline-new-white" href="{{ route('register') }}">Registro</a></p>
                            @endif
                        </div>
                    </div>
                </div>
            </li>
            <li class="text-left">
                <img src="{{asset('img/welcome/slide02.jpg')}}" alt="">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h1 class="m-b-20"><strong>Bienvenidos a <br> Tu Restaurante</strong></h1>
                            <p class="m-b-40">Distribuye las mesas de tu restaurante y<br>
                            gestiona los pedidos de tus clientes.</p>
                            @if (!auth()->user())
                                <p><a class="btn btn-lg btn-circle btn-outline-new-white" href="{{ route('register') }}">Registro</a></p>
                            @endif
                        </div>
                    </div>
                </div>
            </li>
            <li class="text-left">
                <img src="{{asset('img/welcome/slide03.jpg')}}" alt="">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h1 class="m-b-20"><strong>Bienvenidos a <br> Tu Restaurante</strong></h1>
                            <p class="m-b-40">Guarda tus platos y bebidas y<br>
                            tus clientes podrán acceder a la carta mediante código QR.</p>
                            @if (!auth()->user())
                                <p><a class="btn btn-lg btn-circle btn-outline-new-white" href="{{ route('register') }}">Registro</a></p>
                            @endif
                        </div>
                    </div>
                </div>
            </li>
        </ul>
        <div class="slides-navigation">
            <a href="#" class="next"><i class="fa fa-angle-right" aria-hidden="true"></i></a>
            <a href="#" class="prev"><i class="fa fa-angle-left" aria-hidden="true"></i></a>
        </div>
    </div>

    <div class="contact-info-box mt-4">
		<div class="container">
			<div class="row">
				<div class="col-md-3">
					<i class="fa fa-volume-control-phone"></i>
					<div class="overflow-hidden">
						<h4>Teléfono</h4>
						<p class="lead">
							+34 666666666
						</p>
					</div>
				</div>
				<div class="col-md-5">
					<i class="fa fa-envelope"></i>
					<div class="overflow-hidden">
						<h4>Email</h4>
						<p class="lead">
							sebastianbretonesortiz@gmail.com
						</p>
					</div>
				</div>
				<div class="col-md-4">
					<i class="fa fa-map-marker"></i>
					<div class="overflow-hidden">
						<h4>Dirección</h4>
						<p class="lead">
							111, Calle 0
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>

	<footer class="footer-area bg-f mt-4">
		<div class="container">
			<div class="row">
				<div class="col-lg-4 col-md-6">
					<h3>Sobre mi</h3>
					<p>Estudiante de 2º de Desarrollo de Aplicaciones Web que ha realizado esta app para el TFG del grado.</p>
				</div>
				<div class="col-lg-6 col-md-6">
					<h3>MÁS DATOS</h3>
					<p class="lead">111, Calle 0</p>
					<p class="lead">+34 666666666</p>
					<p class="lead">sebastianbretonesortiz@gmail.com</p>
                    <a class="lead" href="https://docs.google.com/document/d/1Wm5emT5ApvCzc86PWDd9gMGw-vIQgw1Duaob_F-u4ts/edit?usp=sharing" target="_blank">Manual de uso</a>
				</div>
                <div class="col-lg-2 col-md-6">
					<h3>Contacto</h3>
					<ul class="list-inline f-social">
						<li class="list-inline-item"><a href="https://www.linkedin.com/in/sebasti%C3%A1n-bretones-ortiz-902377172/" target="_blank"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
					</ul>
				</div>
			</div>
		</div>

		<div class="copyright">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<p class="company-name">All Rights Reserved. &copy; 2021 Tu Restaurante by Sebastián Bretones Ortiz
					</div>
				</div>
			</div>
		</div>
	</footer>
@endsection

@section('js')
    <script src="{{asset('js/welcome/jquery.superslides.min.js')}}"></script>
    <script src="{{asset('js/welcome/custom.js')}}"></script>
@endsection
