<?php

class Aeropuerto extends Eloquent {

	protected $table = 'aeropuertos';
  protected $fillable = array('id');

	public function vuelo()
  {
      return $this->hasMany('Vuelo', 'id');
  }

}
