<!DOCTYPE html>
<html>
  <head>
    <title>Voucher</title>
    <meta charset="utf-8">
    <style>
table {
    border-collapse: collapse;
    width: 100%;
}

th, td {
    text-align: left;
    padding: 8px;
}

tr:nth-child(even){background-color: #f2f2f2}

th {
    background-color: #4CAF50;
    color: white;
}
</style>
  </head>
  <body>
    <h1>Gracias por su compra</h1>
    <table>
      <thead>
        <tr>
          <th>Concepto</th>
          <th>Origen</th>
          <th>Destino</th>
          <th>Fecha</th>
          <th>Adultos</th>
          <th>Niños</th>
          <th>Precio</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>Salida</td>
          <td>{{$salida_origen}}</td>
          <td>{{$salida_destino}}</td>
          <td>{{$salida_fecha}}</td>
          <td>{{$salida_adultos}}</td>
          <td>{{$salida_ninos}}</td>
          <td>${{$salida_precio}}</td>
        </tr>
        @if($regreso_origen)
        <tr>
          <td>Regreso</td>
          <td>{{$regreso_origen}}</td>
          <td>{{$regreso_destino}}</td>
          <td>{{$regreso_fecha}}</td>
          <td>{{$regreso_adultos}}</td>
          <td>{{$regreso_ninos}}</td>
          <td>${{$regreso_precio}}</td>
        </tr>
        @endif
        <tr>
          <td><strong>Total:</strong></td>
          <td>${{$salida_precio + $regreso_precio}}</td>
        </tr>
      </tbody>
    </table>
  </body>
</html>
