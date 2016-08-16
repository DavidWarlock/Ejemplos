@extends('layout.base')
@section('body')
<div class="row">
  <div class="col-md-2">

  </div>
  <div class="col-md-8">
    <div class="panel panel-default">
      <div class="panel-heading">
        Seleccione sus asientos
      </div>
      <div class="panel-body">
        <div class="col-md-5">

        </div>
        <div class="col-md-2">
          @for($i = 1; $i <= $asientos_salida; $i++)
          <a href="#"><span class="glyphicon glyphicon-modal-window" aria-hidden="true"></span></a>
          @endfor
        </div>
        <div class="col-md-5">

        </div>
      </div>
    </div>
  </div>
  <div class="col-md-2">

  </div>
</div>
@stop
