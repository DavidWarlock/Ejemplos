<?php

class Reservacion extends Eloquent
{
  protected $table = 'reservaciones';
  protected $fillable = array('id', 'num_asientos','usuarios_id','pagos_id','itinerarios_id');
  public $timestamps = true;

  public function user()
  {
    return $this->belongsTo('User', 'usuarios_id', 'id');
  }

  public function pago()
  {
    return $this->belongsTo('Pago', 'pagos_id', 'id');
  }

  public function vuelo()
  {
    return $this->belongsTo('Vuelo', 'itinerarios_id', 'id');
  }

}
