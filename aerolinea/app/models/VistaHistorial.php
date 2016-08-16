<?php

class VistaHistorial extends Eloquent
{
  protected $table = 'VistaHistorial';
  protected $fillable = array('id','Origen','Destino','Fecha', 'Asientos', 'Precio');
}
