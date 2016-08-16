@extends('layout.base')
@section('body')
<form method="POST" action="/user/agregarcreditos">
  <div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
      <div class="panel panel-info">
        <div class="panel-heading">
          Agregar saldo a la cuenta
        </div>
        <div class="panel-body">
          <div class="row">
            <div class="col-md-4">
              <form method="POST">
                <div class="form-group">
                  <label for="saldo">Selecciona el monto</label>
                  <select class="form-control" name="saldo">
                    <option value="1000">$1000</option>
                    <option value="2500">$2500</option>
                    <option value="3000">$3000</option>
                    <option value="5000">$5000</option>
                  </select>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="panel panel-info">
        <div class="panel-heading">
          Ingresa información de pago
        </div>
        <div class="panel-body">
          <div class="row">
            <div class="col-md-5">
              <div class="form-group">
                <label for="tipo">Tipo de tarjeta</label>
                <select class="form-control" name="tipo">
                  <option value="VISA">VISA</option>
                  <option value="Mastercard">Mastercard</option>
                  <option value="American Express">American Express</option>
                </select>
              </div>
              <div class="form-group">
                <label for="propietario">Propietario</label>
                <input type="text" class="form-control" name="propietario" placeholder="Nombre de propietario">
              </div>
              <div class="form-group">
                <label for="numero">No. de tarjeta</label>
                <input type="text" class="form-control" name="numero" placeholder="No. de cuenta">
              </div>
              <div class="form-group">
                <label for="codigo">Codigo de seguridad</label>
                <input type="text" class="form-control" name="codigo" placeholder="Código de Seguridad">
              </div>
              <div class="form-group">
                <label for="regreso">Fecha de vencimiento</label>
                  <div class='input-group date' id='dpfecha'>
                      <input type='text' class="form-control" name="fecha"/>
                      <span class="input-group-addon">
                          <span class="glyphicon glyphicon-calendar"></span>
                      </span>
                  </div>
              </div>
              <div class="form-group">
                <label for="direccion">Dirección de facturación</label>
                <input type="text" class="form-control" name="direccion" placeholder="Dirección">
              </div>
              <button type="submit" class="btn btn-info btn-default">Continuar</button>
              @if(Session::has('error'))
                @foreach(Session::get('error')->all() as $validacion)
                  <p class="label label-warning">{{$validacion}}</p>
                @endforeach
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-2"></div>
  </div>
</form>
@stop
@section('js')
<script type="text/javascript">
$('#dpfecha').datetimepicker({
    format: 'YY-MM'
});
</script>
@stop
