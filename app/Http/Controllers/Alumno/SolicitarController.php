<?php namespace App\Http\Controllers\Alumno;

use App\Http\Controllers\Controller;
use Bican\Roles\Models\Role;
use App\User;
use Auth;
use App\Instituciones;
use App\Modalidades;
use App\CarreraUPCI;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Postulantes;
use App\SolicitudPostulante;
use App\CursoInstituciones;
use App\CursosSolicitudPostulante;
use App\Notificaciones;

/** validar datos de la ficha */
use App\Http\Requests\PostFormRequestFichas;
use Input;

class SolicitarController extends Controller {

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
		try {

		    //Se obtiene el id del usuario actual
			$id = Auth::user()->id;

			//Se obtiene el Usuario segùn el id encontrado
			$user = User::find($id);

			if ($user->is('alumno')) 
			{
				/** Consulta las carreras segùn el primer valor de las instituciòn registrada en la bd */
				//$id = Input::get('option');
				$id_usuario = \DB::table('postulantes')->where('usuario_id', $id)->pluck('usuario_id');

				if (is_null($id_usuario) or empty($id_usuario)) {

					$data = ['inst' => array('0' => '-- Seleccione Institución --') + 	Instituciones::lists('nombre', 'id'),
							 'carr' => array('0' => '-- Seleccione Carrera --') + 		CarreraUPCI::lists('nombre','id'),
							 'moda' => array('0' => '-- Seleccione Modalidad --') + 		Modalidades::lists('nombre','id'),
							 'active_principal' => '',
							 'active_notificacion' => '',
							 'active_solicitar' => 'active',
							 'active_class_solicitar'=>'active',
							 'active_class_ampliar'=>'',
							 'active_adjuntar' => '',
							 'active_estado' => '',
							 'carrera_institucion' => array('0' => '-- Seleccione Carrera --')
							 ];

			    	return view('alumno/solicitar', $data);

				} elseif ($id_usuario == $user->id) {

					return redirect('show/cursos');
					
				} 

			} else {
				return view('no_autorizado');
			}


		}catch (Illuminate\Database\Eloquent\ModelNotFoundException $e) {
		     return Response::make('No encontrado', 404);
		}


		

	}


	public function registrarCursos(PostFormRequestFichas $request)
	{	
		try {
			//Se obtiene el id del usuario actual
			$id = Auth::user()->id;


			//De transforma el ingreso de la fecha por el formato correcto a fin de grabar en la bd correctamente.
			$fecha_in = Input::get('fecha_nac_txt');
			$fecha_fo = str_replace("/", "-",$fecha_in);
			$fec = strtotime($fecha_fo);
			
			//Se obtiene los datos ingresados por el postulante.
			$postulante_data = array('codigo'				=> Input::get 	('codigo_alumno_txt'), 
									'apellido_paterno'		=> Input::get 	('apellido_paterno_txt'),
									'apellido_materno'		=> Input::get 	('apellido_materno_txt'),
									'nombres'				=> Input::get 	('nombres_txt'),
									'fecha_nacimiento'		=> date("Y/m/d", $fec),
									'lugar_nacimiento'		=> Input::get 	('lugarNac_txt'),
									'documento_identidad'	=> Input::get 	('docIndentidad_txt'),
									'sexo'					=> Input::get 	('opc_sex'),
									'direccion'				=> Input::get 	('direccion_txt'),
									'telefono_fijo'			=> Input::get 	('telefono_txt'),
									'telefono_celular'		=> Input::get 	('celular_txt'),
									'colegio'				=> Input::get 	('colegio_txt'),
									'tipo_colegio'			=> Input::get 	('opc_colegio'),
									'ubicacion_colegio'		=> Input::get 	('ubicacion_cole_txt'),
									'datos_padres'			=> Input::get 	('padres_txt'),
									'telefono_padres'		=> Input::get 	('telefono_txt_padres'),
									'usuario_id'			=> $id
									);
			
			//Se obtiene los datos de la solicitud
			$estado = 5; //Estado que indica que la Solicitud ya se registro correctamente;

			$ficha_data = array('postulante_id'				=> Input::get 	('codigo_alumno_txt'), 
								'instituciones_id'			=> Input::get 	('institucion_id'),
								'carrera_instit_id'			=> Input::get 	('carrera_id'),
								'ciclo_estudio'				=> Input::get 	('ciclo_txt'),
								'carrera_upci_id'			=> Input::get 	('carrera_postul_id'),
								'modalidad_id'				=> Input::get 	('modalidad'),
								'estado_id'					=> $estado
								);
			
			$carrea = Input::get 	('carrera_id'); 

			/** Según lo seleccionado en la ficha el postulante pertenecera a una Universidad o Instituto de procedencia *
			* Se obtiene el tipo haciendo una consulta a la ficha especificamente al nombre de Institución seleccionada.
			*/
			
			//Graba en la tabla correspondiente
			$ficha = New SolicitudPostulante($ficha_data);
			$ficha->push();
			$ficha->save();

			$postulante = New Postulantes($postulante_data);
			$postulante->save();

			  $notificacion = New Notificaciones();
		      $notificacion->descripcion = 'Se ha registrado la solicitud y los datos personales del postulante.';
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

			//return redirect()->route('registrar');
			return redirect('show/cursos');

		}catch (Illuminate\Database\Eloquent\ModelNotFoundException $e) {
		     return Response::make('No encontrado', 404);
		}

	}

}
