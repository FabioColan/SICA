<?php namespace App\Http\Controllers\Alumno;

use App\Http\Controllers\Controller;
use Bican\Roles\Models\Role;
use App\User;
use Auth;
use Illuminate\Support\Facades\Request;
use Input;
use App\Postulantes;
use App\SolicitudPostulante;
use App\CursoInstituciones;
use App\CursosSolicitudPostulante;
use App\Http\Requests\SeleccionCursosInstitucionRequest;
use App\Http\Requests\NuevoCursosInstitucionRequest;
use App\Notificaciones;

class RegistrarController extends Controller {

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


		//obtengo el codigo de la carrera del alumno logueado
		$carrera_usuario = SolicitudPostulante::join('postulantes','solicitud_postulantes.postulante_id','=','postulantes.codigo')
											->join('users','postulantes.usuario_id','=','users.id')
											->where('postulantes.usuario_id','=', $id)
											->selectRaw('solicitud_postulantes.carrera_instit_id as id')
											->lists('id');

		//obtengo el nombre e id para cargar el select en la vista
		$cursos = CursoInstituciones::join('carrera_instituciones', 'carrera_instituciones.id', '=', 'curso_instituciones.carrera_id')
				            ->join('instituciones', 'instituciones.id', '=', 'carrera_instituciones.institucion_id')
				            ->where('curso_instituciones.carrera_id','=', $carrera_usuario[0] )
				            ->selectRaw("curso_instituciones.nombre as nombre, curso_instituciones.id as id")
				            ->lists('nombre','id');

		//obtengo los cursos que ha registrado el usuario
		$curso_usua = SolicitudPostulante::join('cursos_solicitud_postulantes', 'solicitud_postulantes.id', '=', 'cursos_solicitud_postulantes.solicitud_id')
					->join('users', 'solicitud_postulantes.postulante_id', '=', 'users.id' )
					->join('postulantes','solicitud_postulantes.postulante_id', '=', 'postulantes.codigo')
					->where('users.id', '=', $id)
					->selectRaw('cursos_solicitud_postulantes.id as id, cursos_solicitud_postulantes.nombre as nombre, cursos_solicitud_postulantes.horas as horas, cursos_solicitud_postulantes.nota as nota')
					->lists('id','nombre','horas','nota');

		$data = ['cursos_institucion_carrera' => array('' => '-- Seleccione Curso --') + $cursos,
				 'curso_usua_selec' => array() + $curso_usua,
				 'active_principal' => '',
				 'active_notificacion' => '',
				 'active_solicitar' => 'active',
				 'active_class_solicitar'=>'active',
				 'active_class_ampliar'=>'',
				 'active_adjuntar' => '',
				 'active_estado' => ''
				 ];

		return view('alumno/registrar', $data);

	}

	public function show()
	{

		//Se obtiene el id del usuario actual
		$id = Auth::user()->id;

		//Estado que indica que el alumno ya registro la solicitud de convalidacion y los cursos, 
		//entonces muestra la vista para adjuntar la documentacion
		$estado_id = SolicitudPostulante::join('postulantes','solicitud_postulantes.postulante_id','=','postulantes.codigo')
					->join('users','postulantes.usuario_id','=','users.id')
					->where('postulantes.usuario_id','=', $id)
					->selectRaw('solicitud_postulantes.estado_id as id')
					->lists('id');

		$estad = $estado_id[0];
		
		//dd($estad);
		if (is_null($estado_id)) {
			
			return redirect('/solicitar');

		} elseif ($estad == 5){
					
					//Se obtiene el id del usuario actual
					$id = Auth::user()->id;

					//obtengo el codigo de la carrera del alumno logueado
					$carrera_usuario = SolicitudPostulante::join('postulantes','solicitud_postulantes.postulante_id','=','postulantes.codigo')
														->join('users','postulantes.usuario_id','=','users.id')
														->where('postulantes.usuario_id','=', $id)
														->selectRaw('solicitud_postulantes.carrera_instit_id as id')
														->lists('id');

					//obtengo el nombre e id para cargar el select en la vista
					$cursos = CursoInstituciones::join('carrera_instituciones', 'carrera_instituciones.id', '=', 'curso_instituciones.carrera_id')
							            ->join('instituciones', 'instituciones.id', '=', 'carrera_instituciones.institucion_id')
							            ->where('curso_instituciones.carrera_id','=', $carrera_usuario[0] )
							            ->selectRaw("curso_instituciones.nombre as nombre, curso_instituciones.id as id")
							            ->lists('nombre','id');

					//obtengo los cursos que ha registrado el usuario
					$curso_usua = SolicitudPostulante::join('cursos_solicitud_postulantes', 'solicitud_postulantes.id', '=', 'cursos_solicitud_postulantes.solicitud_id')
								->join('curso_instituciones','cursos_solicitud_postulantes.curso_institucion_id', '=', 'curso_instituciones.id')
								->join('postulantes','solicitud_postulantes.postulante_id', '=', 'postulantes.codigo')
								->join('users', 'postulantes.usuario_id', '=', 'users.id' )
								->where('users.id', '=', $id)
								->selectRaw('cursos_solicitud_postulantes.id as id, curso_instituciones.nombre as nombre, cursos_solicitud_postulantes.horas as horas, cursos_solicitud_postulantes.nota as nota')
								->get('id','nombre','horas','nota');
								//dd($id);

					//dd($curso_usua);
					$data = ['cursos_institucion_carrera' => array('' => '-- Seleccione Curso --') + $cursos,
							 'curso_usua_selec' => $curso_usua,
							 'active_principal' => '',
							 'active_notificacion' => '',
							 'active_solicitar' => 'active',
							 'active_class_solicitar'=>'active',
							 'active_class_ampliar'=>'',
							 'active_adjuntar' => '',
							 'active_estado' => ''
							 ];

					return view('alumno/registrar', $data);	

		} elseif ($estad == 6 ){

			return redirect('show/adjuntos');

		} elseif ($estad == 7 ){

			return redirect('/notificacion');

		}  else {

			return "error no controlado aún";
		}


	}

	public function grabar(SeleccionCursosInstitucionRequest $request)
	{	
		//Se obtiene el id del usuario actual
		$id = Auth::user()->id;

		//obtengo el codigo de solicitud del usuario
		$id_solicitud = SolicitudPostulante::join('postulantes','solicitud_postulantes.postulante_id','=','postulantes.codigo')
									->join('users','postulantes.usuario_id','=','users.id')
									->where('postulantes.usuario_id','=', $id)
									->selectRaw('solicitud_postulantes.id as id')
									->lists('id');


		//INTITUTO SUPERIOR
		$cursos_seleccionados = array(	'nombre' 				=> 'x',
										'creditos'				=> 0,
										'horas' 				=> Input::get('horas'),
										'horas_teoricas'		=> 0,
										'horas_practicas'		=> 0,
										'nota'					=> Input::get('nota'),
										'solicitud_id' 			=> $id_solicitud[0],
										'curso_institucion_id'	=> Input::get('cursos'),
										);


		$cursos_solicitud_postulantes = New CursosSolicitudPostulante($cursos_seleccionados);
		$cursos_solicitud_postulantes->save();


		  

		return redirect('show/cursos');

		
	}

	public function nuevo(NuevoCursosInstitucionRequest $request)
	{

		//Se obtiene el id del usuario actual
		$id = Auth::user()->id;

		$carreraid = User::join('postulantes','users.id','=','postulantes.usuario_id')
						->join('solicitud_postulantes','postulantes.codigo','=','solicitud_postulantes.postulante_id')
						->where('postulantes.usuario_id','=', $id)
						->selectRaw('solicitud_postulantes.carrera_instit_id as id')
						->lists('id');

		;

		//INSTITUTO SUPERIOR
		//CURSO NUEVO QUE SE INGRESARA PORQUE NO ESTA REGISTRADO, SE REGISTRA DIRECTO A LA TABLA MAESTRA, LUEGO EL POSTULANTE LO SELECCIONA
		$cursos_nuevo = array(	'nombre' 				=> Input::get('curso_nombre'),
								'creditos'				=> 0,
								'horas' 				=> 0,
								'horas_teoricas'		=> 0,
								'horas_practicas'		=> 0,
								'carrera_id' 			=> $carreraid[0]
								);


		$cursos_solicitud_postulantes = New CursoInstituciones($cursos_nuevo);
		$cursos_solicitud_postulantes->save();


		return redirect('show/cursos')->withFlashMessage('El curso ha sido agregado correctamente, selecciónelo desde arriba.');
		
	}

	public function delete($id, Request $request){

		$cursos_sol_pos = CursosSolicitudPostulante::find($id);
		$cursos_sol_pos->delete();

		$mensaje = "El curso ".$id." fue eliminado satisfactoriamente.";

		if (Request::ajax())
		{
		    return $mensaje;
		}

		Session::flash('message', $mensaje);
		return redirect('show/cursos');
	}

	public function enviarCursos(){

		//Se obtiene el id del usuario actual
		$id = Auth::user()->id;

		$postulante_id = SolicitudPostulante::join('postulantes','solicitud_postulantes.postulante_id','=','postulantes.codigo')
			->join('users', 'postulantes.usuario_id','=','users.id')
			->where('postulantes.usuario_id', $id)
			->selectRaw('solicitud_postulantes.id as id')
			->lists('id');


		//Se actualiza el estado de la solicitud, que indica que ya se registro la solicitud 
		//de convalidacion y también los cursos, por lo tanto lo que sigue es adjuntar la documentación
		//se redirige al usuario a la vista de adjuntar
		$estado = 6;
		$user = SolicitudPostulante::find($postulante_id[0]);
		$user->estado_id = $estado;
		$user->save();

		$notificacion = New Notificaciones();
	    $notificacion->descripcion = 'Se ha recibido la lista de cursos a convalidar.';
	    $notificacion->usuario_id = $id;
	    $notificacion->estado_id = $estado;
		$notificacion->save();

		$data = ['mensaje' => $notificacion->descripcion];
		\Mail::send('mail', $data, function($message)
		{	
			$email = Auth::user()->email;
			$name = Auth::user()->name;
			$message->to($email, $name)->subject('SICA - UNIVERSIDAD PERUANA DE CIENCIAS E INFORMÁTICA');

		});		
			  
		return redirect('/adjuntar');

	}

}
