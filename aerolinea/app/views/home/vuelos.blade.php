@extends('layout.base')
@section('css')
{{HTML::style('packages/node_modules/bootstrap-table/dist/bootstrap-table.min.css')}}
<style>
#botones button:nth-child(2){
  float: right;
}
.highlight{
    background-color:  #5cd65c!important;
}
</style>
@stop
@section('body')
<div class="row">
  <div class="col-md-1"></div>
  <div class="col-md-10">
    <div class="panel panel-primary">
      <div class="panel-heading">
        Seleccione su vuelo de salida y de regreso
      </div>
      <div class="panel-body">
        <div class="row">
          <div class="col-md-9">
            <p>Tarifa para {{$adultos}} adultos y {{$ninos}} niños</p>
            <label for="salida">Costo de salida:</label>
            <input id="salida" type="text" value="" name="salida"><br>
            <label for="regreso">Costo de Regreso:</label>
            <input id="regreso" type="text" value="" name="regreso"><br>
            <br>
          </div>
          <div class="col-md-3">
            <div class="text-right">
              <form class="" action="/vuelos/compra" method="post">
                <input id="salida_id" type="hidden" value="" name="salida_id">
                <input id="salida_origen" type="hidden" value="" name="salida_origen">
                <input id="salida_destino" type="hidden" value="" name="salida_destino">
                <input id="salida_avion" type="hidden" value="" name="salida_avion">
                <input id="salida_fecha" type="hidden" value="" name="salida_fecha">
                <input id="salida_adultos" type="hidden" value="" name="salida_adultos">
                <input id="salida_ninos" type="hidden" value="" name="salida_ninos">
                <input id="salida_precio" type="hidden" value="" name="salida_precio">
                <input id="regreso_id" type="hidden" value="" name="regreso_id">
                <input id="regreso_origen" type="hidden" value="" name="regreso_origen">
                <input id="regreso_destino" type="hidden" value="" name="regreso_destino">
                <input id="regreso_avion" type="hidden" value="" name="regreso_avion">
                <input id="regreso_fecha" type="hidden" value="" name="regreso_fecha">
                <input id="regreso_adultos" type="hidden" value="" name="regreso_adultos">
                <input id="regreso_ninos" type="hidden" value="" name="regreso_ninos">
                <input id="regreso_precio" type="hidden" value="" name="regreso_precio">

                <button type="submit" id="reservaSalida" class="btn btn-success">Resevar</button>
              </form>
            </div>
          </div>
        </div>
        <div class="panel panel-info">
          <div class="panel-heading">
              Vuelos de salida disponibles
          </div>
          <div class="panel-body">
            <table id="tabla-salida" data-search="true" data-pagination="true">
                 <thead>
                     <tr>
                       <th data-field="Origen" data-sortable="true">Origen</th>
                       <th data-field="Destino" data-sortable="true">Destino</th>
                       <th data-field="Fecha" data-sortable="true">Fecha</th>
                       <th data-field="Precio" data-sortable="true">Precio</th>
                     </tr>
                 </thead>
             </table>
             <br>
          </div>
        </div>
        <div class="panel panel-info">
          <div class="panel-heading">
              Vuelos de regreso disponibles
          </div>
          <div class="panel-body">
            <table id="tabla-regreso" data-search="true" data-pagination="true">
                 <thead>
                     <tr>
                       <th data-field="Origen" data-sortable="true">Origen</th>
                       <th data-field="Destino" data-sortable="true">Destino</th>
                       <th data-field="Fecha" data-sortable="true">Fecha</th>
                       <th data-field="Precio" data-sortable="true">Precio</th>
                     </tr>
                 </thead>
             </table>
             <br>

          </div>
        </div>
      </div>
      </div>
    </div>
  <div class="col-md-1"></div>
</div>
@stop
@section('js')
{{HTML::script('packages/node_modules/bootstrap-table/dist/bootstrap-table.min.js')}}
{{HTML::script('packages/node_modules/bootstrap-table/dist/locale/bootstrap-table-es-ES.min.js')}}
<script>
$(function(){
  var $tableSalidas = $("#tabla-salida");
  var $tableRegresos = $("#tabla-regreso");
  var precio_salida = 0;
  var precio_regreso = 0;
  $tableSalidas.bootstrapTable({
    singleSelect: "true"
  });
  $tableRegresos.bootstrapTable();
  //Consulta vuelos de origen disponibles
  $.ajax({
      url: '/vuelosInfo/{{$origen}}/{{$destino}}/{{$fecha_salida}}/{{$fecha_salida}}',
      type: 'POST',
      datatype: 'json',
      data: {accion: 'consultaSalida'},
  })
  .done(function(response){
    if(response.length > 0){
      $tableSalidas.bootstrapTable('destroy');
      $tableSalidas.bootstrapTable({data: response});
    }else{
      $('#reservaSalida').attr("disabled", true);
    }
  })
  .fail(function(){
      console.log('error');
  })
  .always(function(){
      console.log('complete');
  });
  //Consulta vuelos de destino disponibles
  @if($fecha_regreso)
  $.ajax({
      url: '/vuelosInfo/{{$origen}}/{{$destino}}/{{$fecha_salida}}/{{$fecha_regreso}}',
      type: 'POST',
      datatype: 'json',
      data: {accion: 'consultaRegreso'},
  })
  .done(function(response){
    if(response.length > 0){
      $tableRegresos.bootstrapTable('destroy');
      $tableRegresos.bootstrapTable({data: response});
    }else{
      $('#reservaRegreso').attr("disabled", true);
    }
  })
  .fail(function(){
      console.log('error');
  })
  .always(function(){
      console.log('complete');
  });
  @endif
  $tableSalidas.on('click-row.bs.table', function(row, $element){
      var precio_salida = {{$adultos}} * ($element.Precio * .15) + {{$ninos}} * ($element.Precio * .10) + $element.Precio;
      $('#salida').val(precio_salida);
      $('#salida_id').val($element.id);
      $('#salida_origen').val($element.Origen);
      $('#salida_destino').val($element.Destino);
      $('#salida_avion').val($element.Avion);
      $('#salida_fecha').val($element.Fecha);
      $('#salida_adultos').val({{$adultos}});
      $('#salida_ninos').val({{$ninos}});
      $('#salida_precio').val(precio_salida);
  });

  $tableRegresos.on('click-row.bs.table', function(row, $element){
      var precio_regreso = {{$adultos}} * ($element.Precio * .15) + {{$ninos}} * ($element.Precio * .10) + $element.Precio;
      $('#regreso').val(precio_regreso);
      $('#regreso_id').val($element.id);
      $('#regreso_origen').val($element.Origen);
      $('#regreso_destino').val($element.Destino);
      $('#regreso_avion').val($element.Regreso);
      $('#regreso_fecha').val($element.Fecha);
      $('#regreso_adultos').val({{$adultos}});
      $('#regreso_ninos').val({{$ninos}});
      $('#regreso_precio').val(precio_regreso);
  });

  $tableSalidas.on('click', 'tbody tr', function(event) {
    $(this).addClass('highlight').siblings().removeClass('highlight');
  });

  $tableRegresos.on('click', 'tbody tr', function(event) {
    $(this).addClass('highlight').siblings().removeClass('highlight');
  });
});
</script>
@stop
