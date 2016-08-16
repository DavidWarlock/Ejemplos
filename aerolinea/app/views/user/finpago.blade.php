@extends('layout.base')
@section('body')
<div class="row">
  <div class="col-md-2">
  </div>
  <div class="col-md-8">
    <h1>Gracias por su compra</h1>
    <div class="panel panel-success">
      <div class="panel-heading">
        Información de pago
      </div>
      <div class="panel-body">
        <table class="table table-bordered">
          <thead>
            <th>ID de transaccion</th>
            <th>Cantidad</th>
            <th>Método de pago</th>
            <th>Dirección de factura</th>
            <th>Fecha</th>
          </thead>
          <tbody>
            <td>{{$id}}</td>
            <td>{{$cantidad}}</td>
            <td>{{$metodo}}</td>
            <td>{{$direccion}}</td>
            <td>{{$fecha}}</td>
          </tbody>
        </table>
        <form method="POST" action="/imprimir">
          <input type="hidden" value={{$id}} name="id">
          <input type="hidden" value={{$cantidad}} name="cantidad">
          <input type="hidden" value={{$metodo}} name="metodo">
          <input type="hidden" value={{urlencode($direccion)}} name="direccion">
          <input type="hidden" value={{$fecha}} name="fecha">
          <button type="submit" class="btn btn-info">Imprimir</button>
        </form>
      </div>
    </div>
  </div>
  <div class="col-md-2">
  </div>
</div>
@stop
