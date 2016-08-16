@extends('layout.base')
@section('body')
<div class="row">
  <div class="col-md-4"></div>
  <div class="col-md-4">
    <div class="panel panel-info">
      <div class="panel-heading">
        Iniciar sesión
      </div>
      <div class="panel-body">
        <form method="post" action="/login">
          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-user"></span></span>
              <input type="text" name="username" class="form-control" placeholder="Usuario" aria-describedby="basic-addon1">
            </div>
          </div>
          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-lock"></span></span>
              <input type="password" name="password" class="form-control" placeholder="Contraseña" aria-describedby="basic-addon1">
            </div>
          </div>
            @if(Session::has('aviso'))
              <p class="label label-warning">Usuario y/o contraseña incorrectos</p>
            @endif
            <div class="text-right">
              <button type="submit" class="btn btn-info btn-sm">Entrar</button>
            </div>
        </form>
      </div>
    </div>
  </div>
  <div class="col-md-4"></div>
</div>
@stop
