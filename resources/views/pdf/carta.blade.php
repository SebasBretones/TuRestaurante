<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Carta</title>
    <style>
      body {
        font-family: 'Playfair Display', serif;
        font-style: italic;
        color: #FFB03B;
        background-image: url('../img/pizarra.jpg');
        background-size: cover;
        text-transform: uppercase;
      }
      .titulo {
        font-size: 50px;
        margin-bottom: 60px;
      }
      .subtitulo {
        text-align: left;
        font-size: 40px;
        padding-bottom: 30px;
      }
      .contenedor {
        padding-top: 80px;
      }
      table {
        width: 100%;
      }

      .bCentrado {
        content: "";
        border-bottom: #FFB03B dotted;
      }
      .column1Title{
        text-align: left;
        padding-left: 225px;
        width: 100%;
      }
      .column1 {
        padding-right: 20px;
        text-align: right;
        width: 20%;
      }}
      .column2 {
        text-align: left;
        width: 60%;
      }
      .column3 {
        text-align: left;
        width: 20%;
        padding-left: 20px;
        font-size: 14px;
      }

      td {
        font-size: 22px;
        padding-bottom: 10px;
        text-align: center;
      }

    </style>
  </head>

  <body>
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
        @foreach ($bebidasC as $item)
          <tr>
            <td class="column1">{{$item->nombre}}</td>
            <td class="column2"><p class="bCentrado"></p></td>
            <td class="column3">{{$item->precio}}&euro;</td>
          </tr>
        @endforeach
      </tbody>
    </table>

  </body>
</html>
