@extends('layout.base')
@section('body')
<div class="row">
  <div class="col-md-3"></div>
  <div class="col-md-6">
    <div class="panel panel-info">
      <div class="panel-heading">
        Registro de usuario
      </div>
      <div class="panel-body">
        <form method="post" action="/register">
          <div class="row">
            <div class="col-md-5">
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-user"></span></span>
                  <input type="text" name="nombre" class="form-control" placeholder="Nombre" aria-describedby="basic-addon1">
                </div>
              </div>
            </div>
            <div class="col-md-7">
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-user"></span></span>
                  <input type="text" name="apellidos" class="form-control" placeholder="Apellidos" aria-describedby="basic-addon1">
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
              <div class='input-group date' id='dpfecha'>
                  <input type='text' class="form-control" name="fecha_nac" placeholder="Fecha de nacimiento"/>
                  <span class="input-group-addon">
                      <span class="glyphicon glyphicon-calendar"></span>
                  </span>
              </div>
          </div>
          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-user"></span></span>
              <input type="text" name="username" class="form-control" placeholder="Usuario" aria-describedby="basic-addon1">
            </div>
          </div>
          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-envelope"></span></span>
              <input type="text" name="email" class="form-control" placeholder="E-mail" aria-describedby="basic-addon1">
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-lock"></span></span>
                  <input type="password" name="password" class="form-control" placeholder="Contraseña" aria-describedby="basic-addon1">
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-lock"></span></span>
                  <input type="password" name="comprobacion" class="form-control" placeholder="Comprobación" aria-describedby="basic-addon1">
                </div>
              </div>
            </div>
          </div>
            @if(Session::has('error'))
              @foreach(Session::get('error')->all() as $validacion)
                <p class="label label-warning">{{$validacion}}</p>
              @endforeach
            @endif
            @if(Session::has('aviso'))
              <p class="label label-success">Usuario registrado correctamente</p>
              <strong><p class="label label-info">Le hemos enviado un correo de confirmación</p></strong>
            @endif
            <div class="text-right">
              <button type="submit" class="btn btn-info btn-sm">Registrar</button>
            </div>
        </form>
      </div>
    </div>
  </div>
  <div class="col-md-3"></div>
</div>
@stop
@section('js')
<script type="text/javascript">
$('#dpfecha').datetimepicker({
    format: 'YYYY-MM-DD'
});
</script>
@stop
