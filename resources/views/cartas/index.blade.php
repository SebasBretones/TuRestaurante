@extends('main')

@section('content')
<div class="row justify-content-center" id="loginc">
  @if (is_file('pdf/Carta.pdf'))
    {!!QrCode::size(300)->generate( URL::to('download-carta') ) !!}
  @endif
  <a href="{{URL::to('generate-carta')}}">Generar pdf</a>
</div>


@endsection