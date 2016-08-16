<?php

class UserController extends BaseController {

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

	public function vistaUser()
	{
		$user = Auth::user();
		$reservacion = $user->reservacion()->get()->first();
		if($reservacion)
		{
			$vuelo = Vuelo::where('id',$reservacion->itinerarios_id)->first();
			$origen = $vuelo->aeropuerto_origen()->first()->ciudad;
			$destino = $vuelo->aeropuerto_destino()->first()->ciudad;
			$fecha = $vuelo->fecha_salida;
		}else{
			$origen = null;
			$destino = null;
			$fecha = null;
		}

		return View::make('user.principal')->with(array('origen'=>$origen,
																							'destino'=>$destino,
																							'fecha'=>$fecha));
	}

	public function mostrarReservaciones()
	{
		$user = Auth::user();
		$reservaciones = VistaReservaciones::where('id','=',$user->id)->orderBy('Fecha','desc')->get()->take(4);
		return $reservaciones;
	}

	public function vistaHistorial()
	{
		return View::make('user.historial');
	}

	public function mostrarHistorial()
	{
		$user = Auth::user();
		$historial = VistaHistorial::where('id','=',$user->id)->get();
		return $historial;
	}

	public function vistaCreditos()
	{
		return View::make('user.creditos');
	}

	public function mostrarPagos()
	{
		$user = Auth::user();
		$pagos = Pago::where('usuarios_id','=',$user->id)->get();
		return $pagos;
	}

	public function vistaConfiguracion()
	{
		if(Request::method()=='GET')
			return View::make('user.configuracion');
		$request = Input::all();
		$reglas=array(
	        'email' => 'email|unique:usuarios',
	        'oldpassword' => 'required',
	        'password' => 'required|min:6',
	    );

	    $result_validate = Validator::make($request,$reglas);
	    if ($result_validate->fails()){
	      return Redirect::back()->with('error',$result_validate->messages());
	    }
		$usuario = Auth::user();
		$usuario->update(array('email' => $request['email']));
		if(Auth::attempt(array('password' => $request['oldpassword'])))
		{
			$usuario->update(array('password' => Hash::make($request['password'])));
		}
	}

	public function agregarCreditos(){
		if(Request::method()=='GET')
			return View::make('user.addcreditos');
		$request = Input::all();

		$reglas=array(
				'propietario' => 'required',
				'numero' => 'required|numeric',
				'codigo' => 'required|size:3',
				'fecha' => 'required',
				'direccion' => 'required',
		);

		$result_validate = Validator::make($request,$reglas);
		if ($result_validate->fails()){
			return Redirect::back()->with('error',$result_validate->messages());
		}

		$usuario = Auth::user();
		$saldo = floatval($usuario->saldo + $request['saldo']);
		$pago = new Pago();
		$pago->monto = $saldo;
		$pago->concepto = "Saldo";
		$pago->tipo = $request['tipo'];
		$pago->usuarios_id = $usuario->id;
		$usuario->update(array('saldo' => $saldo));
		$pago->save();
		$direccion = "<strong>Propietario:</strong><br>"
								.	$request['propietario']
								. "<br><strong>Direccion:</strong><br>"
								. $request['direccion'];
		return View::make('user.finpago')->with(array('id'=>$pago->id,
																									'cantidad'=>$request['saldo'],
																									'metodo'=>$request['tipo'],
																									'direccion'=>$direccion,
																									'fecha'=>$pago->created_at));
	}

	public function imprimirPago(){
		$request = Input::all();
    $html = View::make('user.voucher')->with(array('id'=>$request['id'],
																							'cantidad'=>$request['cantidad'],
																							'metodo'=>$request['metodo'],
																							'direccion'=>$request['direccion'],
																							'fecha'=>$request['fecha']))->render();
    return PDF::load($html, 'A4', 'portrait')->download('my_pdf');
	}

	public function actionLogin(){
		if(Request::method()=='GET')
			return View::make('user.login');
    $request = array(
        'username' => Input::get('username'),
        'password' => Input::get('password'),
        'active' => 1
    );
    //Comando para intentar autenticar en base a la tabla usuarios
    if (Auth::attempt($request))
    {
      return Redirect::intended('/');
    }
    else
    {
      return Redirect::back()->with('aviso', 'true');
    }
  }

	public function actionRegister(){
		if(Request::method()=='GET')
			return View::make('user.register');
		$request = Input::all();
    $reglas=array(
				'nombre' => 'required',
				'apellidos' => 'required',
				'fecha_nac' => 'required',
        'username' => 'required|min:10|unique:usuarios',
        'email' => 'required|email|unique:usuarios',
        'password' => 'required|min:6',
        'comprobacion' => 'required|min:6|same:password'
    );

    $result_validate = Validator::make($request,$reglas);
    if ($result_validate->fails()){
      return Redirect::back()->with('error',$result_validate->messages());
    }
		$ver_code = str_random(30) . time();
    $usuario = new User();
		$usuario->username = $request['username'];
		$usuario->email = $request['email'];
		$usuario->password = Hash::make($request['password']);
		$usuario->nombre = $request['nombre'];
		$usuario->apellidos = $request['apellidos'];
		$usuario->fecha_nac = $request['fecha_nac'];
		$usuario->verification_code = $ver_code;

		$usuario->save();

		Mail::send('emails.verificar', array('confirmation_code'=>$ver_code), function($message) {
            $message->to(Input::get('email'), Input::get('username'))
                ->subject('Verify your email address');
        });


    return Redirect::back()->with('aviso',true);
  }

	public function verificarCuenta($confirmation_code){

		if($usuario = User::where('verification_code', '=', $confirmation_code))
		{
				$usuario->update(array('active' => 1));
				$usuario->update(array('verification_code' => null));
		}

		return View::make('user.verified');
	}

	public function logout(){
		Auth::logout();
		return Redirect::back();
	}

	public function Upload()
  {
		$imagen = Input::file('image');
		$path = public_path('media/users/');
		$name = uniqid() . "." . $imagen->getClientOriginalExtension();
		$resized = Image::make($imagen)->resize(320, 320)->save($path . $name);

		$usuario = Auth::user();
		if($usuario->foto)
		{
			$old = $path . $usuario->foto;
    	unlink($old);
		}
		$usuario->update(array('foto' => $name));
    return Redirect::back();
  }
}
