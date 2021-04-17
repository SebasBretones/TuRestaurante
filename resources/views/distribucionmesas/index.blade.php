@extends('partials.bVacio')
@section('body')
@extends('partials.navigation')

<div align="center">
    <div class="mt-10">
        {{$distribucionMesas->links()}}
    </div>
    @foreach ($distribucionMesas as $item)
        <ul class="listing">
          <div class="row">
            <div class="well col-md-4 col-md-offset-4">
              <li class="mesa-title">  {{$item->nombre}} </li>
            </div>
          </div>
        </ul>
    @endforeach
    <div class="mt-10">
        {{$distribucionMesas->links()}}
    </div>
    </div>
@endsection
