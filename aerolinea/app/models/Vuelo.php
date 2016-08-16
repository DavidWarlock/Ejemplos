<?php

class Vuelo extends Eloquent
{
  protected $table = 'itinerarios';
  protected $fillable = array('id', 'aviones_id', 'pilotos_id','aeropuertos_origen','aeropuertos_destino');
  public $timestamps = true;

  public function aeropuerto_origen()
  {
    return $this->belongsTo('Aeropuerto', 'aeropuertos_origen', 'id');
  }

  public function aeropuerto_destino()
  {
    return $this->belongsTo('Aeropuerto', 'aeropuertos_destino', 'id');
  }

  public function reservacion()
  {
      return $this->hasMany('Reservacion', 'itinerarios_id');
  }
}
