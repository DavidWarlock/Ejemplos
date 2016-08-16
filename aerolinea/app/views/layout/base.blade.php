<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Aerolinea</title>
    <style>
    body{
      background-color: #F2F2F2!important;
    }
    </style>
    <!-- Bootstrap -->
    {{HTML::style('packages/node_modules/bootstrap/dist/css/bootstrap.min.css')}}
    {{HTML::style('packages/node_modules/bootstrap/dist/css/bootstrap-theme.min.css')}}

    {{HTML::style('packages/node_modules/bootstrap/dist/css/styles.css')}}
    {{HTML::style('packages/node_modules/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css')}}
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    @yield('css')
  </head>
  <body>
    <nav class="navbar navbar-default">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Brand</a>
        </div>

        <div class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <a href="/" class="navbar-brand"><span class="glyphicon glyphicon-plane" aria-hidden="true"></span>&nbsp; Aerolinea</a>
          <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
          </button>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </div>
        <div class="navbar-collapse collapse" id="navbar-main">
          <ul class="nav navbar-nav navbar-right">
            @if(Auth::check())
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>&nbsp; Usuario<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="/user">Mi perfil</a></li>
                <li><a href="/user/creditos">Créditos</a></li>
                <li><a href="/user/configuracion">Configuración</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="/logout">Cerrar sesión</a></li>
              </ul>
            </li>
            @endif
            @if(!Auth::check())
            <li><a role="button" href="/login">Entrar</a></li>
            <li><a role="button" href="/register">Registro</a></li>
            @endif
          </ul>
        </div>
      </div>
    </div>
  </nav>
  <div class="container container-fluid">
    <div class="row">
      <div class="col-lg-12 white">
        @yield('body')
        <div class="row">
          <div class="col-lg-12">
            <br><br><br>
            <p>© 2016 Aerolinea. Todos los derechos reservados.</p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div id="registro-modal" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Registro de usuario</h4>
        </div>
        <div class="modal-body">
      </div><!-- /.modal-content -->
    </div>
  </div>


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    {{HTML::script('packages/node_modules/jquery/dist/jquery.min.js')}}
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    {{HTML::script('packages/node_modules/bootstrap/dist/js/bootstrap.min.js')}}
    {{HTML::script('/packages/node_modules/moment/min/moment.min.js')}}
    {{HTML::script('/packages/node_modules/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js')}}
    @yield('js')
  </body>
</html>
