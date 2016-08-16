@extends('layout.base')
@section('css')
{{HTML::style('packages/node_modules/bootstrap-table/dist/bootstrap-table.min.css')}}
@stop
@section('body')
<div class="panel panel-deafault">
  <div class="panel-body">
    <div class="page-header">
      <h1>Reservación<small>&nbsp;Complete los datos para confirmar su vuelo</small></h1>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">
        <p>Informacion de reservación</p>
      </div>
      <div class="panel-body">
        <table class="table table-bordered">
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
      </div>
    </div>
  </div>
  <div class="panel-body">
    <div class="panel panel-default">
      <div class="panel-heading">
        <p>Confirmación de pago</p>
      </div>
      <div class="panel-body">
        <h3>Credito disponible<h3>
        <h4>${{Auth::user()->saldo}}</h4>
        <div class="text-right">
          @if(Auth::user()->saldo >= ($salida_precio + $regreso_precio))
          <form class="" action="/vuelos/compra/confirmar" method="post">
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
            <button type="submit" class="btn btn-success">Confirmar pago</button>
          </form>
          @else
            <p class="label label-warning">No cuentas con saldo suficiente</p>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>
@stop
@section('js')
{{HTML::script('packages/node_modules/bootstrap-table/dist/bootstrap-table.min.js')}}
{{HTML::script('packages/node_modules/bootstrap-table/dist/locale/bootstrap-table-es-ES.min.js')}}
@stop
