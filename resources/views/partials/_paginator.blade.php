@if (count($array)!=0)
  <div class="mt-4" id="paginacion">
    <div id="left">
      {{$array->links()}}
    </div>
    <div class="small" id="right">
      {{$array->firstItem()}} - {{$array->lastItem()}} de {{$array->total()}}
    </div>
  </div>
@endif