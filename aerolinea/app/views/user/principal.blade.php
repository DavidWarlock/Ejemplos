@extends('layout.user')
@section('header')
<span class="glyphicon glyphicon-home"></span>&nbsp;Principal
@stop
@section('headersub')
Información de la cuenta
@stop
@section('body')
<div class="media">
  <div class="media-left">
    <span class="glyphicon glyphicon-plane"></span>
  </div>
  <div class="media-body">
    <h4 class="media-heading">Última reservación realizada</h4>
    <strong><p>{{$origen}} - {{$destino}}</p></strong>
    <p>{{$fecha}}</p>
  </div>
</div>
<br>
<div class="panel panel-default">
  <div class="panel-heading">
    <p>Reservaciones recientes</p>
  </div>
  <div class="panel-body">
    <table id="tabla-reservaciones">
         <thead>
             <tr>
               <th data-field="Origen" data-sortable="true">Origen</th>
               <th data-field="Destino" data-sortable="true">Destino</th>
               <th data-field="Fecha" data-sortable="true">Fecha</th>
               <th data-field="Precio" data-sortable="true">Precio</th>
             </tr>
         </thead>
     </table>
  </div>
</div>
<div class="panel panel-default">
  <div class="panel-heading">
    <p><span class="glyphicon glyphicon-bitcoin"></span>&nbsp;Crédito disponible</b>
  </div>
  <div class="panel-body">
    <h3>${{Auth::user()->saldo}}</h3>
  </div>

  </div>

</div>
@stop
@section('js')
<script>
$(function(){
  var $tablareservaciones = $("#tabla-reservaciones");
  $tablareservaciones.bootstrapTable();
  $.ajax({
      url: '/user/reservaciones',
      type: 'POST',
      datatype: 'json',
      data: {accion: 'consultaSalida'},
  })
  .done(function(response){
    console.log(response);
    if(response.length > 0){
      $tablareservaciones.bootstrapTable('destroy');
      $tablareservaciones.bootstrapTable({data: response});
    }
  })
  .fail(function(){
      console.log('error');
  })
  .always(function(){
      console.log('complete');
  });
});
</script>
@stop
