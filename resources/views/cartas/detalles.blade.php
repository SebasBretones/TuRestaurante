<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/carta.css') }}" />
    <title>Carta</title>
  </head>

  <body>
      <div class="container">
        <div class="contenedor">
        <table>
            <thead>
            <tr>
                <th> </th>
                <th class="titulo">Carta {{auth()->user()->name}}</th>
                <th> </th>
            </tr>
            </thead>
        </table>
        </div>

        <div class="contenedor">
        <table>
            <thead>
            <tr>
                <th class="subtitulo column1Title">BEBIDAS CON TAPA</th>
                <th></th>
                <th></th>
            </tr>
            </thead>
        </table>
        </div>

        <table>
        <tbody>
            @foreach ($bebidasC as $item)
            <tr>
                <td class="column1">{{$item->nombre}}</td>
                <td class="column2"><p class="bCentrado"></p></td>
                <td class="column3">{{$item->precio}}&euro;</td>
            </tr>
            @endforeach
        </tbody>
        </table>

        <div class="contenedor">
        <table>
            <thead>
            <tr>
                <th class="subtitulo column1Title">BEBIDAS SIN TAPA</th>
                <th></th>
                <th></th>
            </tr>
            </thead>
        </table>
        </div>

        <table>
        <tbody>
            @foreach ($bebidasS as $item)
            <tr>
                <td class="column1">{{$item->nombre}}</td>
                <td class="column2"><p class="bCentrado"></p></td>
                <td class="column3">{{$item->precio}}&euro;</td>
            </tr>
            @endforeach
        </tbody>
        </table>

        <div class="contenedor">
        <table>
            <thead>
            <tr>
                <th class="subtitulo column1Title">Raciones</th>
                <th></th>
                <th></th>
            </tr>
            </thead>
        </table>
        </div>

        <table>
        <tbody>
            @foreach ($raciones as $item)
            <tr>
                <td class="column1">{{$item->nombre}}</td>
                <td class="column2"><p class="bCentrado"></p></td>
                <td class="column3">{{$item->precio}}&euro;</td>
            </tr>
            @endforeach
        </tbody>
        </table>

        <div class="contenedor">
        <table>
            <thead>
            <tr>
                <th class="subtitulo column1Title">tapas</th>
                <th></th>
                <th></th>
            </tr>
            </thead>
        </table>
        </div>

        <table>
        <tbody>
            @foreach ($tapas as $item)
            <tr>
                <td class="column1">{{$item->nombre}}</td>
                <td class="column2"><p class="bCentrado"></p></td>
                <td class="column3">{{$item->precio}}&euro;</td>
            </tr>
            @endforeach
        </tbody>
        </table>

</div>

  </body>
</html>
