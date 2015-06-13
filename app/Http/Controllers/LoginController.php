<?php namespace App\Http\Controllers;

use Bican\Roles\Models\Role;
use App\User;
use Auth;

class LoginController extends Controller {

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

		/** Se obtiene el id del usuario actual */
		$id = Auth::user()->id;

		/** Se obtiene el Usuario segùn el id encontrado */
		$user = User::find($id);

		/** se valida el acceso de acuerdo al rol del usuario autenticado */
		if ($user->is('admin')) 
		{
 			$data = ['us'=> \DB::table('lista_usuarios')->get(),
					'active_principal' => '',
					'active_usuario' => 'active',
					'active_mantenimiento'=>'',
					'active_class_inst' => '',
					'active_class_carr_inst'=>'',
					'active_class_cur_inst' => '',
					'active_class_moda' => '',
					'active_class_facu_upci'=>'',
					'active_class_carr_upci'=>'',
					'active_class_plan_upci'=>'',
					'active_class_cur_upci'=>'',
					'active_class_cicl_upci'=>''
					];

			return view('administrador/usuario', $data);

		} elseif ($user->is('alumno'))
		{
			$data = ['active_principal' => 'active',
					 'active_notificacion' => '',
					 'active_solicitar' => '',
					 'active_class_solicitar'=>'',
					 'active_class_ampliar'=>'',
					 'active_adjuntar' => '',
					 'active_estado' => ''
					 ];
			return view('alumno/principal', $data);

		} elseif ($user->is('comision'))
		{
			

			$data = ['var_solicitud' => \DB::table('listado_solicitud_postulantes')->get(),
					'var_post'=> \DB::table('listado_postulantes_comision')->get(),
 					'active_principal' => 'active',
 					'active_validar'=> '',
 					'active_convalidar' => '',
 					'active_reporte' => '',
 					'active_class_alumno'=>'',
 					'active_class_cuadro'=>'',
 					'active_class_memorando'=>'',
 					'active_estado' => ''
 					];
 					
 			return view('comision/principal', $data);

 		} elseif ($user->is('inactivo')){

 			return view('/inactivo');

		} else
		{	
			/** ASIGO EL ROL DE CODIGO=2 POR DEFECTO CADA VEZ QUE SE REGISTRAN. POR DEFECTO TIENEN EL ROL DE ALUMNOS */
			$user = User::find($id)->attachRole(2);

			/** SE ENVIA LOS DATOS PARA EL MENÚ*/
			$data = ['active_principal' => 'active',
					 'active_notificacion' => '',
					 'active_solicitar' => '',
					 'active_class_solicitar'=>'',
					 'active_class_ampliar'=>'',
					 'active_adjuntar' => '',
					 'active_estado' => ''
					 ];

			return view('alumno/principal', $data);
			
			/** A CONTINUACIÓN SE LLAMA A LA VISTA DEL ALUMNO */
			//return view('alumno/principal');
		}

	
	}

	public function validar()
	{
		return view('comision/validar');
	}

}
