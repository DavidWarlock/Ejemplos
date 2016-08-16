@extends('layout.base')
@section('css')
{{HTML::style('/packages/node_modules/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css')}}
<style>
  .vuela{
    background-image: url("media/images/vuelanosotros.jpg");
  }
  .vuela h2{
    color: #fff;
    text-shadow: 2px 2px 5px black;
  }
  .registra{
    background-image: url("media/images/registrateahora.jpg");
  }
  .registra h2{
    color: #fff;
    text-shadow: 2px 2px 5px black;
  }
  .credito{
    padding-left: 20px!important;
    background-image: url("media/images/agregacreditos.jpg");
  }
  .credito h4{
    color: #fff;
    text-shadow: 2px 2px 5px black;
  }
</style>
@stop
@section('body')
<div class="jumbotron vuela">
  <h2>Vuela con nosotros</h2>
  <br>
  <br>
  <br><br><br>
</div>
<div class="row">
  <div class="col-md-5">
    <div class="panel panel-default">
      <div class="panel-body">
        <form method="POST" action="/buscarVuelo">
          <div class="form-group">
            <label for="origen">Origen:</label>
            <select class="form-control" name="origen">
              @foreach($ciudades as $item)
              <option value="{{$item->id}}">{{$item->ciudad}}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="destino">Destino:</label>
            <select class="form-control" name="destino">
              @foreach($ciudades as $item)
              <option value="{{$item->id}}">{{$item->ciudad}}</option>
              @endforeach
            </select>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="adultos">Adultos:</label>
                <select class="form-control" name="adultos">
                  <option value="1">1 adulto</option>
                  <option value="2">2 adultos</option>
                  <option value="3">3 adultos</option>
                  <option value="4">4 adultos</option>
                  <option value="5">5 adultos</option>
                  <option value="6">6 adultos</option>
                  <option value="7">7 adultos</option>
                  <option value="8">8 adultos</option>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="ninos">Niños:</label>
                <select class="form-control" name="ninos">
                  <option value="0">0 niños</option>
                  <option value="1">1 niño</option>
                  <option value="2">2 niños</option>
                  <option value="3">3 niños</option>
                  <option value="4">4 niños</option>
                  <option value="5">5 niños</option>
                  <option value="6">6 niños</option>
                  <option value="7">7 niños</option>
                  <option value="8">8 niños</option>
                </select>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="salida">Salida:</label>
              <div class='input-group date' id='dpsalida'>
                  <input type='text' class="form-control" name="salida"/>
                  <span class="input-group-addon">
                      <span class="glyphicon glyphicon-calendar"></span>
                  </span>
              </div>
          </div>
          <div class="form-group">
            <label for="regreso">Regreso:</label>
              <div class='input-group date' id='dpregreso'>
                  <input type='text' class="form-control" name="regreso"/>
                  <span class="input-group-addon">
                      <span class="glyphicon glyphicon-calendar"></span>
                  </span>
              </div>
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-info">Buscar</button>
          </div>
         </form>
         @if(Session::has('error'))
           @foreach(Session::get('error')->all() as $validacion)
             <p class="label label-warning">{{$validacion}}</p>
           @endforeach
         @endif
        </div>
    </div>
    <div class="jumbotron credito">
      <h4>Agrega crédito a tu cuenta</h4>
      <p><a class="btn btn-info btn-sm" href="/user/creditos" role="button">Más información</a></p>
    </div>
  </div>
  <div class="col-md-7">
    <div class="panel panel-default">
      <div class="panel-body">
        <div class="jumbotron registra">
          <h2>Registrate ahora <br>y obten beneficios</h2>
          <br>
          <p><a id="registro" class="btn btn-success btn-lg" href="/register" role="button">Registrarse</a></p>
        </div>
        <div class="list-group">
          @foreach ($vuelos as $item)
          <a href="#" class="list-group-item">
            <h4 class="list-group-item-heading">De: {{$item->aeropuerto_origen()->first()->estado}}</h4>
            <h3 class="list-group-item-heading">a: {{$item->aeropuerto_destino()->first()->estado}}</h3>
            <p class="list-group-item-text">Fecha salida: {{$item->fecha_salida}}</p>
          </a>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</div>
@stop
@section('js')
<script type="text/javascript">
    $(function () {
        $('#dpsalida').datetimepicker({
            format: 'YYYY-MM-DD'
        });
        $('#dpregreso').datetimepicker({
            format: 'YYYY-MM-DD',
            useCurrent: false //Important! See issue #1075
        });
        $("#dpsalida").on("dp.change", function (e) {
            $('#dpregreso').data("DateTimePicker").minDate(e.date);
        });
        $("#dpregreso").on("dp.change", function (e) {
            $('#dpregreso').data("DateTimePicker").minDate(e.date);
        });
    });
</script>
@stop
