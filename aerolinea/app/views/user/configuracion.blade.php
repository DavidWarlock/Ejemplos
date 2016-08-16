@extends('layout.user')
@section('header')
<span class="glyphicon glyphicon-cog"></span>&nbsp;Configuración
@stop
@section('headersub')
Opciones de la cuenta
@stop
@section('body')
  <h4>Cambiar foto</h4>
  <div class="row">
    <div class="col-md-3">
      <a id="thumb" class="thumbnail">
        @if(Auth::user()->foto)
        <img src="../media/users/{{Auth::user()->foto}}" alt="Profile picture">
        @else
        <img src="../media/users/profile.jpg" alt="Profile picture">
        @endif
      </a>
			<form action="/upload" method="post" enctype="multipart/form-data">
				<input id="file" type="file" name="image">
        <br>
				<button class="btn btn-sm btn-info" type="submit">Subir</button>
			</form>
    </div>
  </div>
  <hr>
  <form method="POST" action="/user/configuracion">
  <h4>Datos de la cuenta</h4>
  <div class="row">
    <div class="col-md-5">
      <div class="form-group">
        <label for="email">Cambiar correo:</label>
        <div class="input-group">
          <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-envelope"></span></span>
          <input type="text" name="email" class="form-control" placeholder="E-mail" aria-describedby="basic-addon1">
        </div>
      </div>
    </div>
  </div>
  <hr>
  <div class="row">
    <div class="col-md-5">
      <div class="form-group">
        <label for="oldpassword">Contraseña anterior:</label>
        <div class="input-group">
          <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-envelope"></span></span>
          <input type="password" name="oldpassword" class="form-control" placeholder="Contraseña anterior" aria-describedby="basic-addon1">
        </div>
      </div>
      <hr>
      <div class="form-group">
        <label for="password">Nueva contraseña:</label>
        <div class="input-group">
          <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-envelope"></span></span>
          <input type="password" name="password" class="form-control" placeholder="Nueva contraseña" aria-describedby="basic-addon1">
        </div>
      </div>
      @if(Session::has('error'))
        @foreach(Session::get('error')->all() as $validacion)
          <p class="label label-warning">{{$validacion}}</p>
        @endforeach
      @endif
    </div>
  </div>
  <br>
  <div class="text-right">
    <button type="submit" class="btn btn-info btn-default">Guardar cambios</button>
  </div>
</div>
</form>
@stop
@section('js')
<script type="text/javascript">
  $('#thumb').on('click',function(){
    $('#file').trigger('click');
  });
</script>
@stop
