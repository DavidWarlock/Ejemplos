<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function vistaIndex()
	{
    $ciudades = $this->consultaComboCiudad();
		$vuelos = $this->consultaVuelos();
		return View::make('home.index')->with(array('ciudades' =>	$ciudades, 'vuelos' => $vuelos));
	}

	public function consultaVuelos()
	{
		$consulta = Vuelo::all()->take(3);
		return $consulta;
	}

	public function consultaComboCiudad()
	{
		$consulta = Aeropuerto::all();
  		return $consulta;
	}

	public function buscarVuelo()
	{
		$request = Input::all();
		$reglas=array(
				'salida' => 'date|required'
		);

		$result_validate = Validator::make($request,$reglas);
		if ($result_validate->fails()){
			return Redirect::back()->with('error',$result_validate->messages());
		}
		$ciudades = $this->consultaComboCiudad();
		return View::make('home.vuelos')->with(array('origen'=>$request['origen'],
																								'destino'=>$request['destino'],
																								'ciudades'=>$ciudades,
																								'adultos'=>$request['adultos'],
																								'ninos'=>$request['ninos'],
																								'fecha_salida'=>$request['salida'],
																								'fecha_regreso'=>$request['regreso']));
	}

	public function mostrarVuelos($origen, $destino, $salida, $regreso=null)
	{
		switch (Input::get('accion'))
		{
			case 'consultaSalida':
					return $this->obtenerVuelosSalida($origen, $destino, $salida);
				break;
			case 'consultaRegreso':
					return $this->obtenerVuelosRegreso($origen, $destino, $regreso);
				break;
			default:
					return array();
				break;
		}
	}

	public function comprarVuelos()
	{
		$request = Input::all();
		if(Auth::check()) {
			return View::make('home.pago')->with(array('salida_id'=>$request['salida_id'],
																								'salida_origen'=>$request['salida_origen'],
																								'salida_destino'=>$request['salida_destino'],
																								'salida_fecha'=>$request['salida_fecha'],
																								'salida_adultos'=>$request['salida_adultos'],
																								'salida_ninos'=>$request['salida_ninos'],
																								'salida_precio'=>$request['salida_precio'],
																								'regreso_id'=>$request['regreso_id'],
																								'regreso_origen'=>$request['regreso_origen'],
																								'regreso_destino'=>$request['regreso_destino'],
																								'regreso_fecha'=>$request['regreso_fecha'],
																								'regreso_adultos'=>$request['regreso_adultos'],
																								'regreso_ninos'=>$request['regreso_ninos'],
																								'regreso_precio'=>$request['regreso_precio']
																								));
		}else{
			return View::make('user.login');
		}
	}
/*
	public function seleccionAsientos()
	{
		if(Request::method() == 'GET')
			$request = Input::all();
			$avionsalida = Avion::where('id','=',$request['salida_avion'])->first();
			$avionregreso = Avion::where('id','=',$request['regreso_avion'])->first();
			if($avionregreso)
			{
				return View::make('home.asientos')->with(array('asientos_salida'=>$avionsalida->asientos_total,
																											'asientos_regreso'=>$avionregreso->asientos_total ));
			}else{
				return View::make('home.asientos')->with('asientos_salida',$avionsalida->asientos_total);
			}
	}
*/
	public function confirmarPago()
	{
		$request = Input::all();
		$usuario = Auth::user();
		$asientos = $request['salida_ninos'] + $request['salida_adultos'];
		$monto = $request['salida_precio'] + $request['regreso_precio'];

		$pago = new Pago();
		$pago->monto = $monto;
		$pago->tipo = "Saldo";
		$pago->concepto = "Reservacion";
		$pago->usuarios_id = $usuario->id;
		$pago->save();

		$reservacion = new Reservacion();
		$reservacion->num_asientos = $asientos;
		$reservacion->usuarios_id = $usuario->id;
		$reservacion->pagos_id = $pago->id;
		$reservacion->itinerarios_id = $request['salida_id'];
		$reservacion->save();

		$saldo = $usuario->saldo - $monto;
		$usuario->update(array('saldo' => $saldo));


		if($request['regreso_id'])
		{
			$reservacion2 = new Reservacion();
			$reservacion2->num_asientos = $request['salida_ninos'] + $request['salida_adultos'];
			$reservacion2->usuarios_id = Auth::user()->id;
			$reservacion2->pagos_id = $pago->id;
			$reservacion2->itinerarios_id = $request['regreso_id'];
			$reservacion2->save();
		}


		return View::make('home.finpago')->with(array('salida_id'=>$request['salida_id'],
																							'salida_origen'=>$request['salida_origen'],
																							'salida_destino'=>$request['salida_destino'],
																							'salida_fecha'=>$request['salida_fecha'],
																							'salida_adultos'=>$request['salida_adultos'],
																							'salida_ninos'=>$request['salida_ninos'],
																							'salida_precio'=>$request['salida_precio'],
																							'regreso_id'=>$request['regreso_id'],
																							'regreso_origen'=>$request['regreso_origen'],
																							'regreso_destino'=>$request['regreso_destino'],
																							'regreso_fecha'=>$request['regreso_fecha'],
																							'regreso_adultos'=>$request['regreso_adultos'],
																							'regreso_ninos'=>$request['regreso_ninos'],
																							'regreso_precio'=>$request['regreso_precio']
																							));
	}

	public function imprimirPago()
	{
			$request = Input::all();
	    $html = View::make('home.voucher')->with(array('salida_origen'=>$request['salida_origen'],
																								'salida_destino'=>$request['salida_destino'],
																								'salida_fecha'=>$request['salida_fecha'],
																								'salida_adultos'=>$request['salida_adultos'],
																								'salida_ninos'=>$request['salida_ninos'],
																								'salida_precio'=>$request['salida_precio'],
																								'regreso_origen'=>$request['regreso_origen'],
																								'regreso_destino'=>$request['regreso_destino'],
																								'regreso_fecha'=>$request['regreso_fecha'],
																								'regreso_adultos'=>$request['regreso_adultos'],
																								'regreso_ninos'=>$request['regreso_ninos'],
																								'regreso_precio'=>$request['regreso_precio']
																								));
	    return PDF::load($html, 'A4', 'portrait')->download('my_pdf');
	}

	public function obtenerVuelosSalida($id_origen, $id_destino, $salida)
	{
		$consulta = VistaVuelos::where('id_origen','=',$id_origen)
														->where('id_destino','=',$id_destino)
														->whereDate('Fecha', '=', $salida)->get();
		return $consulta;
	}

	public function obtenerVuelosRegreso($id_origen, $id_destino, $regreso)
	{
		$consulta = VistaVuelos::where('id_origen','=',$id_destino)
														->where('id_destino','=',$id_origen)
														->whereDate('Fecha', '=', $regreso)->get();
		return $consulta;
	}

}
