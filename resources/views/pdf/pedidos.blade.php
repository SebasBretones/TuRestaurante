<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Factura</title>
  <style>
    table {
      width: 100%;
      background-color: #fff;
      text-align: center;
    }
    
    th, td {
      font-weight: unset;
      padding-right: 0.5rem;
    }
    
    .pColumn3 {
      width: 20%;
    }
    
    .pColumn4 {
      width: 25%;
    }
    .pColumn5 {
      width: 25%;
    }
    
    .column6 {
      width: 15%;
    }
    
    .column7 {
      width: 15%;
    }

    .row100.head th {
      padding-top: 1.75rem;
      padding-bottom: 1.75rem;
    }
    
    .row100 td {
      padding-top: 18px;
      padding-bottom: 14px;
    }

  .table100.ver3 tbody tr {
      border-bottom: 1px solid #e5e5e5;
    }
    
    .table100.ver3 td {
      font-size: 1.1rem;
      color: rgba(0, 0, 0, 0.863);
      line-height: 1.4;
    }
    
    .table100.ver3 th {
      font-size: 1rem;
      color: #fff;
      line-height: 1.4;
      text-transform: uppercase;
      background-color: #6c7ae0;
    }
    
    .table100.ver3 .row100:hover td {
      background-color: #fcebf5;
    }
    
    .table100.ver3 .hov-column-ver3 {
      background-color: #fcebf5;
    }
    
    .table100.ver3 .hov-column-head-ver3 {
      background-color: #7b88e3 !important;
    }
    
    .table100.ver3 .row100 td:hover {
      background-color: #e03e9c;
      color: #fff;
    }

    .res {
      overflow-x:auto;
    }
  </style>
</head>
<body>
  <div class="padre table100 ver3 res m-b-110">
    <table data-vertable="ver3">
        <thead>
            <tr class="row100 head">
                <th class="pColumn4">Tapa</th>
                <th class="pColumn5">Bebida</th>
                <th class="pColumn6">Cantidad</th>
                <th class="pColumn3">Precio</th>
                <th class="pColumn7">Total a pagar</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pedidos as $ped)
                @php
                    $pedido= '\App\Models\Pedido'::find($ped->id)
                @endphp   
                <tr class="row100">
                    <td class="pColumn4">
                        @php
                            $tapa = DB::table('tapas')->find($ped->tapa_id)
                        @endphp
                        @if ($tapa!=null)
                            {{$tapa->nombre}}
                        @endif
                    </td>
                    <td class="pColumn5">
                        @php
                            $bebida = DB::table('bebidas')->find($ped->bebida_id)
                        @endphp
                        @if ($bebida!=null)
                            {{$bebida->nombre}}
                        @endif
                    </td>
                    <td class="pColumn6">{{$ped->cantidad}}</td>
                    <td class="pColumn3">{{$ped->total_pedido}} €</td>
                    <td class="pColumn7"></td>
                </tr>
            @endforeach
            <tr class="row100">
              <td class="pColumn4">
              </td>
              <td class="pColumn5">
              </td>
              <td class="pColumn6"></td>
              <td class="pColumn3"></td>
              <td class="pColumn7">{{$factura->total_factura}} €</td>
            </tr>
        </tbody>
    </table>
</div>
</body>
</html>