@extends('main')
@section('content')
<div align="center" class="mt-5">
    <ul class="nav nav-pills mb-3 justify-content-center pr" id="pills-tab" role="tablist">
        @foreach ($distribucion as $item)
          <li class="nav-item" role="presentation">
            <button class="nav-link" data-bs-toggle="pill" data-bs-target="#pills-{{$item->nombre}}" type="button" role="tab">{{$item->nombre}}</button>
          </li>
        @endforeach
      </ul>
      @include('mesas.index')
</div>
@endsection
