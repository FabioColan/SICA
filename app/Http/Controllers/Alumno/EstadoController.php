<?php namespace App\Http\Controllers\Alumno;

use App\Http\Controllers\Controller;

class EstadoController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');

		

	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function show()
	{	
				$data = ['active_principal' => '',
						 'active_notificacion' => '',
						 'active_solicitar' => '',
						 'active_class_solicitar'=>'',
						 'active_class_ampliar'=>'',
						 'active_adjuntar' => '',
						 'active_estado' => 'active',
						 ];
		return view('alumno/estado',$data);
	}
}
