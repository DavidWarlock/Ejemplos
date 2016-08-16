@extends('layout.base')
@section('css')
{{HTML::style('packages/node_modules/bootstrap-table/dist/bootstrap-table.min.css')}}
<style media="screen">
  .media span{
    font-size: 30pt;
  }
  .user-options a{
    color: #2c3e50!important;
  }
</style>
@overwrite
@section('body')
<div class="row">
  <div class="col-md-3">
    <div class="panel panel-default">
      <div class="panel-body">
        <a href="/user" class="thumbnail">
          @if(Auth::user()->foto)
          <img src="../media/users/{{Auth::user()->foto}}" alt="Profile picture">
          @else
          <img src="../media/users/profile.jpg" alt="Profile picture">
          @endif
        </a>
        <div class="row">
        <hr>
          <ul class="nav nav-stacked user-options">
            <li><a href="/user"><i class="glyphicon glyphicon-home"></i>&nbsp; Principal</a></li>
            <li><a href="/user/historial"><i class="glyphicon glyphicon-list-alt"></i>&nbsp; Historial</a></li>
            <li><a href="/user/creditos"><i class="glyphicon glyphicon-bitcoin"></i>&nbsp; Créditos</a></li>
            <hr>
            <li><a href="/user/configuracion"><i class="glyphicon glyphicon-cog"></i>&nbsp; Configuración</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-9">
    <div class="panel panel-default">
      <div class="panel-body">
        <div class="page-header">
          <h2>@yield('header')<small>&nbsp;@yield('headersub')</small></h2>
          <hr>
        </div>
        @yield('body')
      </div>
    </div>
  </div>
</div>
@overwrite
@section('js')
{{HTML::script('packages/node_modules/bootstrap-table/dist/bootstrap-table.min.js')}}
{{HTML::script('packages/node_modules/bootstrap-table/dist/locale/bootstrap-table-es-ES.min.js')}}
@yield('js')
@overwrite
