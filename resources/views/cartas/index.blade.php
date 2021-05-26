@extends('main')

@section('content')

<div class="col-12 text-center mt-5">
  <a class="btn btn-success" href="{{URL::to('generate-carta')}}">GENERAR CARTA</a>
  <div class="mt-5"> 
    @if (is_file('pdf/user'.auth()->user()->id.'/Carta.pdf'))
      {!!QrCode::size(200)->generate( URL::to('download-carta') ) !!}
    @endif
  </div>
</div>


@endsection