<div class="tab-content" id="pills-tabContent">
    @foreach ($distribucionV as $item)
    <div class="tab-pane fade show active" id="pills-{{$item->nombre}}" role="tabpanel">
        @php
            $mesasxdist='App\Models\Mesa'::where('distribucion_id', $item->id)->get();
        @endphp
        @foreach ($mesasxdist as $mesa)
        {{$mesa->num_asientos}}
        <hr/>
        @endforeach
    </div>
    @endforeach
</div>
