<?php namespace App\Http\Controllers\Comision;

use App\Http\Controllers\Controller;
use Bican\Roles\Models\Role;
use App\User;
use Auth;
use App\Postulantes;

class NotificacionController extends Controller {

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

	
	public function index()
	{	
		//Se obtiene el id del usuario actual
		$id = Auth::user()->id;

		//Se obtiene el Usuario segùn el id encontrado
		$user = User::find($id);

		if ($user->is('comision')) 
		{
			
			$data = [
					'var_post'=> \DB::table('postulantes')->get(),
 					'active_principal_com' => '',
 					'active_notificacion_com' => 'active',
 					'active_convalidar_com' => '',
 					'active_reporte_com' => '',
 					'active_class_alumno_com'=>'',
 					'active_class_cuadro_com'=>'',
 					'active_class_memorando_com'=>'',
 					'active_estado_com' => ''
 					];
 					
 			return view('comision/notificacion_com', $data);

		} else {

			return 'No autorizado';

		}

	}


	public function notificacioncomision(){

		return view('comision/notificacion_com');
		
	}
}
