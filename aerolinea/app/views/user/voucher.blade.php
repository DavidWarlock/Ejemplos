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
          <th>ID de transaccion</th>
          <th>Cantidad</th>
          <th>Método de pago</th>
          <th>Dirección de factura</th>
          <th>Fecha</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>{{$id}}</td>
          <td>${{$cantidad}}</td>
          <td>{{$metodo}}</td>
          <td>{{urldecode($direccion)}}</td>
          <td>{{$fecha}}</td>
        </tr>
      </tbody>
    </table>
  </body>
</html>
