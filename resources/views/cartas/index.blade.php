@extends('main')

@section('content')
<div class="row justify-content-center" id="loginc">
  {!!QrCode::size(300)->generate( URL::to('download-carta') ) !!}
</div>

@endsection