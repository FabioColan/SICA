<?php namespace App\Http\Controllers\Comision;

use App\Http\Controllers\Controller;
use Bican\Roles\Models\Role;
use App\User;
use Auth;
use Request;
use App\SolicitudPostulante;

class PrincipalController extends Controller {

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

			$data = ['var_solicitud' => \DB::table('listado_solicitud_postulantes')->get(),
					'var_post'=> \DB::table('listado_postulantes_comision')->get(),
 					'active_principal' => 'active',
 					'active_validar' => '',
 					'active_convalidar' => '',
 					'active_reporte' => '',
 					'active_class_alumno'=>'',
 					'active_class_cuadro'=>'',
 					'active_class_memorando'=>'',
 					'active_estado' => ''
 					];
 					
 			return view('comision/principal', $data);

		} else {
			return 'No autorizado';
		}

	}


	public function principalcomision(){
		return view('comision/principal_com');
	}

	public function show(){
		return redirect('comision');
	}

	public function ver_solicitud($codigo){
		
		$postulante = \DB::table('postulantes')->where('codigo', $codigo)->get();
		//obtengo las careras de la solicitud del usuario
		$solicitud = SolicitudPostulante::join('postulantes','solicitud_postulantes.postulante_id','=','postulantes.codigo')
						->join('users','postulantes.usuario_id','=','users.id')
						->join('carrera_instituciones','solicitud_postulantes.carrera_instit_id','=','carrera_instituciones.id')
						->join('instituciones','solicitud_postulantes.instituciones_id','=','instituciones.id')
						->join('carrera_upci','solicitud_postulantes.carrera_upci_id','=','carrera_upci.id')
						->join('modalidades','solicitud_postulantes.modalidad_id','=','modalidades.id')
						->where('postulantes.codigo','=', $codigo)
						->selectRaw('solicitud_postulantes.id as id, 
									carrera_upci.nombre as nombre_ca_upci, 
									carrera_instituciones.nombre as nombre_ca_inst, 
									instituciones.nombre as nombre_inst,
									users.name as nombre_usuario,
									users.email as correo,
									instituciones.nombre as institucion,
									carrera_instituciones.nombre as carrera_ins,
									carrera_upci.nombre as carrera_upci,
									modalidades.nombre as modalidad,
									solicitud_postulantes.ciclo_estudio as ciclo ')
						->get('id','nombre_ca_upci','nombre_ca_inst', 'nombre_ca_upci','nombre_inst','nombre_usuario','correo',
								'institucion','carrera_ins','carrera_upci','modalidad','ciclo');

		
		

		if (Request::ajax())
		{
		    return response()->json([ 
		    		'mensaje' => 'hola',
		    		'nombres'=>  $postulante[0]->nombres,
		    		'apellido_paterno'=>  $postulante[0]->apellido_paterno,
		    		'apellido_materno'=>  $postulante[0]->apellido_materno,
		    		'codigo'=>  $postulante[0]->codigo,
		    		'fecha_nacimiento'=>  $postulante[0]->fecha_nacimiento,
		    		'lugar_nacimiento'=>  $postulante[0]->lugar_nacimiento,
		    		'documento_identidad'=>  $postulante[0]->documento_identidad,
		    		'sexo'=>  $postulante[0]->sexo,
		    		'direccion'=>  $postulante[0]->direccion,
		    		'telefono_fijo'=>  $postulante[0]->telefono_fijo,
		    		'telefono_celular'=>  $postulante[0]->telefono_celular,
		    		'colegio'=>  $postulante[0]->colegio,
		    		'tipo_colegio'=>  $postulante[0]->tipo_colegio,
		    		'ubicacion_colegio'=>  $postulante[0]->ubicacion_colegio,
		    		'datos_padres'=>  $postulante[0]->datos_padres,
		    		'telefono_padres'=>  $postulante[0]->telefono_padres,
		    		'nombre_usuario'=>  $solicitud[0]->nombre_usuario,
		    		'correo'=>  $solicitud[0]->correo,
		    		'institucion'=>  $solicitud[0]->institucion,
		    		'carrera_ins'=>  $solicitud[0]->carrera_ins,
		    		'carrera_upci'=>  $solicitud[0]->carrera_upci,
		    		'modalidad'=>  $solicitud[0]->modalidad,
		    		'ciclo'=>  $solicitud[0]->ciclo,
		    	]);
		}

	}
}
