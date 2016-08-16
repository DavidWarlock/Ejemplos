@extends('layout.user')
@section('header')
<span class="glyphicon glyphicon-bitcoin"></span>&nbsp;Créditos
@stop
@section('headersub')
Dinero electrónico de la cuenta
@stop
@section('body')
<div class="media-body">
  <h4 class="media-heading">Crédito disponible</h4>
  <strong><p>Total:</p></strong>
  <p>${{Auth::user()->saldo}}</p>
</div>
<p><a class="btn btn-info btn-sm" href="/user/agregarcreditos" role="button">Agregar</a></p>
<hr>
<div class="panel panel-default">
  <div class="panel-heading">
    <p>Historial de pagos</p>
  </div>
  <div class="panel-body">
    <table id="tabla-pagos" data-search="true" data-pagination="true">
         <thead>
             <tr>
               <th data-field="id" data-sortable="true">#</th>
               <th data-field="concepto" data-sortable="true">Concepto</th>
               <th data-field="tipo" data-sortable="true">Tipo</th>
               <th data-field="monto" data-sortable="true">Monto</th>
               <th data-field="created_at" data-sortable="true">Fecha</th>
             </tr>
         </thead>
     </table>
  </div>
</div>
@stop
@section('js')
<script type="text/javascript">
  $(function(){
    var $tablapagos = $("#tabla-pagos");
    $tablapagos.bootstrapTable();
    $.ajax({
        url: '/user/pagostable',
        type: 'POST',
        datatype: 'json',
        data: {accion: 'consultaSalida'},
    })
    .done(function(response){
      console.log(response);
      if(response.length > 0){
        $tablapagos.bootstrapTable('destroy');
        $tablapagos.bootstrapTable({data: response});
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
