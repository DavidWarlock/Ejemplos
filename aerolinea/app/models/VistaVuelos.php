<?php

class VistaVuelos extends Eloquent
{
  protected $table = 'VistaVuelos';
  protected $fillable = array('id','id_origen','id_destino','Origen', 'Destino', 'Fecha','Precio');

}
