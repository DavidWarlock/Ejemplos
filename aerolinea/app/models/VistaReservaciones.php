<?php

class VistaReservaciones extends Eloquent
{
  protected $table = 'VistaReservaciones';
  protected $fillable = array('id','Origen','Destino','Fecha', 'Precio');

}
