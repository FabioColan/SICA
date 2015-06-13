<?php namespace App\Http\Controllers\Alumno;

use App\Http\Controllers\Controller;
use Auth;
use App\Notificaciones;
use App\User;

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
	
	public function show()
	{	
		try {

		//Se obtiene el id del usuario actual
		$id = Auth::user()->id;

			//Se obtiene el Usuario segùn el id encontrado
		$user = User::find($id);

			if ($user->is('alumno')) 
			{
				//Se obtiene el id del usuario actual
				$id = Auth::user()->id;

				$notifi = Notificaciones::join('users','notificaciones.usuario_id','=','users.id')
					->join('postulantes','postulantes.usuario_id','=','notificaciones.usuario_id')
					->join('solicitud_postulantes','postulantes.codigo','=','solicitud_postulantes.postulante_id')
					->where('notificaciones.usuario_id','=', $id)
					->selectRaw("postulantes.apellido_paterno as paterno, postulantes.apellido_materno as 
						materno, postulantes.nombres as nombres,
						solicitud_postulantes.postulante_id as codigo, notificaciones.descripcion as descripcion, 
						notificaciones.estado_id as estado, DATE_FORMAT(notificaciones.created_at,'%d %b %Y %T') as fecha")
					->get('codigo','paterno','materno','nombres','descripcion','estado','fecha');
				
				$data = ['active_principal' => '',
						 'active_notificacion' => 'active',
						 'active_solicitar' => '',
						 'active_class_solicitar'=>'',
						 'active_class_ampliar'=>'',
						 'active_adjuntar' => '',
						 'active_estado' => '',
						 'notifi' => $notifi
						 ];

				return view('alumno/notificacion',$data);

			} else {
					return view('no_autorizado');
			}

		}catch (Illuminate\Database\Eloquent\ModelNotFoundException $e) {
		     return Response::make('No encontrado', 404);
		}
		
	}
}
