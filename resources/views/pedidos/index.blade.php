@extends('main')
@section('title')
Todos los pedidos
@endsection
@section('content')
<div class="d-flex justify-content-end mb-4">
    <a class="btn btn-primary" href="{{ URL::to('download-pdf') }}">Export to PDF</a>
</div>

{!!QrCode::size(300)->generate( URL::to('download-pdf') ) !!}

<table class="table table-bordered mb-5">
    <thead>
        <tr class="table-danger">
            <th scope="col">ID</th>
            <th scope="col">Total</th>
            <th scope="col">Cantidad</th>
            <th scope="col">Tapa</th>
            <th scope="col">Bebida</th>
            <th scope="col">Estado</th>
            <th scope="col">Mesa</th>
        </tr>
    </thead>
    <tbody>
        @foreach($pedidos as $data)
        <tr>
            <th scope="row">{{ $data->id }}</th>
            <td>{{ $data->total_pedido }}</td>
            <td>{{ $data->cantidad }}</td>
            <td>{{ $data->tapa_id }}</td>
            <td>{{ $data->bebida_id }}</td>
            <td>{{ $data->estado_id }}</td>
            <td>{{ $data->mesa_id }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection
