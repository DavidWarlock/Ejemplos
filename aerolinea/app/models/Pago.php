<?php

class Pago extends Eloquent
{
  protected $table = 'pagos';
  public $timestamps = true;

  public function reservacion()
  {
      return $this->hasMany('Reservacion', 'reservacion_id');
  }


}
