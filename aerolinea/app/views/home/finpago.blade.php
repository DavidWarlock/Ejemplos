@extends('layout.base')
@section('body')
<div class="row">
  <div class="col-md-2">
  </div>
  <div class="col-md-8">
    <h1>Gracias por su compra</h1>
    <div class="panel panel-success">
      <div class="panel-body">
        <form class="" action="/vuelos/compra/confirmar/imprimir" method="post">
          <input type="hidden" value="{{$salida_id}}" name="salida_id">
          <input type="hidden" value="{{$salida_origen}}" name="salida_origen">
          <input type="hidden" value="{{$salida_destino}}" name="salida_destino">
          <input type="hidden" value="{{$salida_fecha}}" name="salida_fecha">
          <input type="hidden" value="{{$salida_adultos}}" name="salida_adultos">
          <input type="hidden" value="{{$salida_ninos}}" name="salida_ninos">
          <input type="hidden" value="{{$salida_precio}}" name="salida_precio">
          <input type="hidden" value="{{$regreso_id}}" name="regreso_id">
          <input type="hidden" value="{{$regreso_origen}}" name="regreso_origen">
          <input type="hidden" value="{{$regreso_destino}}" name="regreso_destino">
          <input type="hidden" value="{{$regreso_fecha}}" name="regreso_fecha">
          <input type="hidden" value="{{$regreso_adultos}}" name="regreso_adultos">
          <input type="hidden" value="{{$regreso_ninos}}" name="regreso_ninos">
          <input type="hidden" value="{{$regreso_precio}}" name="regreso_precio">
          <button type="submit" class="btn btn-success">Imprimir Voucher</button>
        </form>
      </div>
    </div>
  </div>
  <div class="col-md-2">
  </div>
</div>
@stop
