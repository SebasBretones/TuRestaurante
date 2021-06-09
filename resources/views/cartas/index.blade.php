@extends('main')

@section('content')

<div class="col-12 text-center mt-5">
  <div class="mt-5">
      {!!QrCode::size(200)->generate( URL::to('generate-carta',$user) ) !!}
  </div>
</div>


@endsection

