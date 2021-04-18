@extends('main')
@section('content')
<div class="flex justify-end mt-5">
    <form name="search">
        <select name="distribucion_id" class="form-select px-1" onchange="this.form.submit()">
            <option value="%">  Cualquiera</option>
            <option @if($selectOption=='1') selected @endif value="1">Terraza</option>
            <option @if($selectOption=='2') selected @endif value="2">Barra</option>
            <option @if($selectOption=='3') selected @endif value="3">Interior</option>
        </select>
    </form>
</div>
<div align="center" class="mt-5">
    <table class="table table-success table-striped">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Situada</th>
                <th scope="col">Ocupada</th>
                <th scope="col">Asientos</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($mesas as $mesa)
                @php
                    $distribucionAct = 'App\Models\Distribucion'::find($mesa->distribucion_id);
                    $nombreAct = $distribucionAct->nombre;
                @endphp
                <tr>
                    <td>{{$mesa->id}}</td>
                    <td>{{$nombreAct}}</td>
                    <td>{{$mesa->ocupada}}</td>
                    <td>{{$mesa->num_asientos}}</td>
                </tr>
                @endforeach
            </tbody>
    </table>
    {{$mesas->links()}}
</div>
@endsection
