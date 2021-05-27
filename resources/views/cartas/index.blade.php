@extends('main')

@section('content')

<div class="col-12 text-center mt-5">
  <a class="btn btn-success" href="{{URL::to('generate-carta',$user)}}">GENERAR CARTA</a>
  <div class="mt-5"> 
    @if (is_file('pdf/user'.$user->id.'/Carta.pdf'))
      {!!QrCode::size(200)->generate( URL::to('download-carta',$user) ) !!}
    @endif
  </div>
</div>


@endsection