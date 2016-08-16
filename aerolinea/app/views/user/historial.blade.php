@extends('layout.user')
@section('header')
<span class="glyphicon glyphicon-list-alt"></span>&nbsp;Historial
@stop
@section('headersub')
Historial de vuelos
@stop
@section('body')
<div class="panel panel-default">
  <div class="panel-heading">
    <p>Historial de vuelos</p>
  </div>
  <div class="panel-body">
    <table id="tabla-historial" data-search="true" data-pagination="true">
         <thead>
             <tr>
               <th data-field="Origen" data-sortable="true">Origen</th>
               <th data-field="Destino" data-sortable="true">Destino</th>
               <th data-field="Fecha" data-sortable="true">Fecha</th>
               <th data-field="Asientos" data-sortable="true">Asientos</th>
               <th data-field="Precio" data-sortable="true">Precio</th>
             </tr>
         </thead>
     </table>
    <br>
    <div class="text-right">
      <p><a class="btn btn-success btn-default" href="/" role="button">Buscar nuevo</a></p>
    </div>
  </div>
</div>
@stop
@section('js')
<script type="text/javascript">
$(function(){
  var $tablahistorial = $("#tabla-historial");
  $tablahistorial.bootstrapTable();
  $.ajax({
      url: '/user/historialtable',
      type: 'POST',
      datatype: 'json',
      data: {accion: 'consultaSalida'},
  })
  .done(function(response){
    console.log(response);
    if(response.length > 0){
      $tablahistorial.bootstrapTable('destroy');
      $tablahistorial.bootstrapTable({data: response});
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
