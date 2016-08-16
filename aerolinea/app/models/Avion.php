<?php

class Avion extends Eloquent {

	protected $table = 'aviones';
  protected $fillable = array('id','asientos_total','asientos_ocup');

	public function vuelo()
  {
      return $this->hasMany('Vuelo', 'id');
  }

}
