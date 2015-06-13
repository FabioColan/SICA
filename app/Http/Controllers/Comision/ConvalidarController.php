<?php namespace App\Http\Controllers\Comision;

use App\Http\Controllers\Controller;
use Bican\Roles\Models\Role;
use App\User;
use Auth;
use App\Instituciones;
use App\Documentacion;
use App\SolicitudPostulante;
use App\CicloUPCI;
use App\Http\Requests\GrabarCursosCuadroRequest;
use Request;
use App\CuadroConvalidacionPostulantes;
use Redirect;

class ConvalidarController extends Controller {

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

	
	public function index($cod_postu)
	{	
		//Se obtiene el id del usuario actual
		$id = Auth::user()->id;

		//Se obtiene el Usuario segùn el id encontrado
		$user = User::find($id);

		if ($user->is('comision')) 
		{

			//$cod_postu = Request::input('cod_pos_grabar');

			//obtego el codigo del usuario del postulante, para realizar la carga de información
			$postulante = \DB::table('postulantes')->where('codigo', $cod_postu)->first();

			//obtengo las careras de la solicitud del usuario
			$solicitud = SolicitudPostulante::join('postulantes','solicitud_postulantes.postulante_id','=','postulantes.codigo')
							->join('users','postulantes.usuario_id','=','users.id')
							->join('carrera_instituciones','solicitud_postulantes.carrera_instit_id','=','carrera_instituciones.id')
							->join('instituciones','solicitud_postulantes.instituciones_id','=','instituciones.id')
							->join('carrera_upci','solicitud_postulantes.carrera_upci_id','=','carrera_upci.id')
							->where('postulantes.codigo','=', $cod_postu)
							->selectRaw('solicitud_postulantes.id as id, carrera_upci.nombre as nombre_ca_upci, 
								carrera_instituciones.nombre as nombre_ca_inst, instituciones.nombre as nombre_inst')
							->get('id','nombre_ca_upci','nombre_ca_inst', 'nombre_ca_upci','nombre_inst');
							
							//dd($solicitud);
							//dd(\DB::table('documentacion')->get());
			
			$adjuntos = Documentacion::join('solicitud_postulantes','documentacion.solicitud_id','=' ,'solicitud_postulantes.id')
							->join('postulantes','solicitud_postulantes.postulante_id','=','postulantes.codigo')
							->join('tipo_documentos','documentacion.tipo_id','=','tipo_documentos.id')
							->where('postulantes.codigo','=', $cod_postu)
							->selectRaw("tipo_documentos.nombre as tipo, documentacion.nombre_actual as nombre, DATE_FORMAT(documentacion.created_at,'%d %b %Y %T') as fecha")
							->get('tipo','nombre','fecha');

			//obtengo los cursos que ha registrado el usuario
			$curso_usua = SolicitudPostulante::join('cursos_solicitud_postulantes', 'solicitud_postulantes.id', '=', 'cursos_solicitud_postulantes.solicitud_id')
					->join('curso_instituciones', 'cursos_solicitud_postulantes.curso_institucion_id', '=', 'curso_instituciones.id' )
					->join('postulantes','solicitud_postulantes.postulante_id', '=', 'postulantes.codigo')
					->where('postulantes.codigo', '=', $cod_postu )
					->selectRaw('cursos_solicitud_postulantes.id as id, curso_instituciones.nombre as nombre, cursos_solicitud_postulantes.horas as horas, cursos_solicitud_postulantes.nota as nota')
					->get('id','nombre','horas','nota');

			$id_soli_postulante = \DB::table('solicitud_postulantes')->where('postulante_id', $cod_postu)->first();
			//dd($curso_usua);
			$cuadro_lista = CuadroConvalidacionPostulantes::join('curso_carrera_upci','cuadro_convalidacion_postulantes.curso_carrera_upci_id','=','curso_carrera_upci.id')
								->join('cursos_solicitud_postulantes','cuadro_convalidacion_postulantes.curso_solipos_id','=','cursos_solicitud_postulantes.id')
								->join('curso_instituciones','cursos_solicitud_postulantes.curso_institucion_id','=','curso_instituciones.id')
								->join('ciclo_upci','curso_carrera_upci.ciclo_upci_id','=','ciclo_upci.id')
								->where('cuadro_convalidacion_postulantes.solicitud_postulantes','=',$id_soli_postulante->id)
								->selectRaw('cuadro_convalidacion_postulantes.id as id, ciclo_upci.abreviatura as ciclo,
									curso_carrera_upci.codigo as codigo_curso_upci,
									curso_carrera_upci.nombre as nombre_curso_upci,
									curso_carrera_upci.creditos as creditos,
									curso_carrera_upci.hora_teorica as hora_teorica,
									curso_carrera_upci.hora_practica as hora_practica,
									curso_carrera_upci.th as th,
									cuadro_convalidacion_postulantes.nota_curso_upci as nota_curso_upci,
									(
									select cur_i.nombre from curso_instituciones cur_i where cur_i.id = 
									(select cusp.curso_institucion_id from cursos_solicitud_postulantes cusp where cusp.id=
									(select cua_c.curso_solipos_id from cuadro_convalidacion_postulantes cua_c where cua_c.id=cuadro_convalidacion_postulantes.id)
									)

									) as nombre_curso_i,
									cursos_solicitud_postulantes.horas as hora_curso_i,
									cuadro_convalidacion_postulantes.nota_curso_institucion as nota_curso_i, 
									cuadro_convalidacion_postulantes.solicitud_postulantes as cod_soli_pos')
								->orderBy('cuadro_convalidacion_postulantes.created_at','desc')
								->get('id','ciclo','codigo_curso_upci','nombre_curso_upci','creditos','hora_teorica','hora_practica','th','nota_curso_upci','nombre_curso_i',
									'hora_curso_i','nota_curso_i','cod_soli_pos');

			$data = ['var_doc'=> $adjuntos,
					'esta' => array('' => '-- Seleccione Estado --') + 	\DB::table('estados')->whereIn('id', [2, 3])->lists('nombre','id'),
		 			'active_principal' => '',
		 			'active_validar' => 'active',
		 			'active_convalidar' => '',
		 			'active_reporte' => '',
		 			'active_class_alumno'=>'',
		 			'active_class_cuadro'=>'',
		 			'active_class_memorando'=>'',
		 			'active_estado' => '',
		 			'postulante' => $postulante,
		 			'solicitu' => $solicitud,
		 			'cursos_solicitud' => $curso_usua,
		 			'ciclos' => array('-- Seleccione Ciclo --') + CicloUPCI::lists('nombre', 'id'),
		 			'cursos_upci' => array('0' => '-- Seleccione Curso --'),
		 			'cuadro'=> $cuadro_lista
 					];
 					
 			//dd($data);
 			return view('comision/convalidar', $data);

		} else {
			return 'No autorizado';
		}

	}


	public function convalidarcomision(){
		return view('comision/convalidar');
	}


	public function grabar(GrabarCursosCuadroRequest $request){
		//dd(Request::input('cursos_institucion'));
		//dd(Request::input('cursos_upci'));
			//se obtiene el codigo del postulantes para volver a generar la pagina
			$cod_postu = Request::input('cod_pos_grabar');


		//obtego el codigo del usuario del postulante, para realizar la carga de información
			$postulante = \DB::table('postulantes')->where('codigo', $cod_postu)->first();

			//obtengo las careras de la solicitud del usuario
			$solicitud = SolicitudPostulante::join('postulantes','solicitud_postulantes.postulante_id','=','postulantes.codigo')
							->join('users','postulantes.usuario_id','=','users.id')
							->join('carrera_instituciones','solicitud_postulantes.carrera_instit_id','=','carrera_instituciones.id')
							->join('instituciones','solicitud_postulantes.instituciones_id','=','instituciones.id')
							->join('carrera_upci','solicitud_postulantes.carrera_upci_id','=','carrera_upci.id')
							->where('postulantes.codigo','=', $cod_postu)
							->selectRaw('solicitud_postulantes.id as id, carrera_upci.nombre as nombre_ca_upci, 
								carrera_instituciones.nombre as nombre_ca_inst, instituciones.nombre as nombre_inst')
							->get('id','nombre_ca_upci','nombre_ca_inst', 'nombre_ca_upci','nombre_inst');
							
							//dd($solicitud);
							//dd(\DB::table('documentacion')->get());
			
			$adjuntos = Documentacion::join('solicitud_postulantes','documentacion.solicitud_id','=' ,'solicitud_postulantes.id')
							->join('postulantes','solicitud_postulantes.postulante_id','=','postulantes.codigo')
							->join('tipo_documentos','documentacion.tipo_id','=','tipo_documentos.id')
							->where('postulantes.codigo','=', $cod_postu)
							->selectRaw("tipo_documentos.nombre as tipo, documentacion.nombre_actual as nombre, DATE_FORMAT(documentacion.created_at,'%d %b %Y %T') as fecha")
							->get('tipo','nombre','fecha');

			//obtengo los cursos que ha registrado el usuario
			$curso_usua = SolicitudPostulante::join('cursos_solicitud_postulantes', 'solicitud_postulantes.id', '=', 'cursos_solicitud_postulantes.solicitud_id')
					->join('curso_instituciones', 'cursos_solicitud_postulantes.curso_institucion_id', '=', 'curso_instituciones.id' )
					->join('postulantes','solicitud_postulantes.postulante_id', '=', 'postulantes.codigo')
					->where('postulantes.codigo', '=', $cod_postu )
					->selectRaw('cursos_solicitud_postulantes.id as id, curso_instituciones.nombre as nombre, cursos_solicitud_postulantes.horas as horas, cursos_solicitud_postulantes.nota as nota')
					->get('id','nombre','horas','nota');

			$id_soli_postulante = \DB::table('solicitud_postulantes')->where('postulante_id', $cod_postu)->first();

			$cuadro_lista = CuadroConvalidacionPostulantes::join('curso_carrera_upci','cuadro_convalidacion_postulantes.curso_carrera_upci_id','=','curso_carrera_upci.id')
								->join('cursos_solicitud_postulantes','cuadro_convalidacion_postulantes.curso_solipos_id','=','cursos_solicitud_postulantes.id')
								->join('curso_instituciones','cursos_solicitud_postulantes.curso_institucion_id','=','curso_instituciones.id')
								->join('ciclo_upci','curso_carrera_upci.ciclo_upci_id','=','ciclo_upci.id')
								->where('cuadro_convalidacion_postulantes.solicitud_postulantes','=',$id_soli_postulante->id)
								->selectRaw('cuadro_convalidacion_postulantes.id as id, ciclo_upci.abreviatura as ciclo,
									curso_carrera_upci.codigo as codigo_curso_upci,
									curso_carrera_upci.nombre as nombre_curso_upci,
									curso_carrera_upci.creditos as creditos,
									curso_carrera_upci.hora_teorica as hora_teorica,
									curso_carrera_upci.hora_practica as hora_practica,
									curso_carrera_upci.th as th,
									cuadro_convalidacion_postulantes.nota_curso_upci as nota_curso_upci,
									(
									select cur_i.nombre from curso_instituciones cur_i where cur_i.id = 
									(select cusp.curso_institucion_id from cursos_solicitud_postulantes cusp where cusp.id=
									(select cua_c.curso_solipos_id from cuadro_convalidacion_postulantes cua_c where cua_c.id=cuadro_convalidacion_postulantes.id)
									)

									) as nombre_curso_i,
									cursos_solicitud_postulantes.horas as hora_curso_i,
									cuadro_convalidacion_postulantes.nota_curso_institucion as nota_curso_i, 
									cuadro_convalidacion_postulantes.solicitud_postulantes as cod_soli_pos')
								->orderBy('cuadro_convalidacion_postulantes.created_at','desc')
								->get('id','ciclo','codigo_curso_upci','nombre_curso_upci','creditos','hora_teorica','hora_practica','th','nota_curso_upci','nombre_curso_i',
									'hora_curso_i','nota_curso_i','cod_soli_pos');

			$data = ['var_doc'=> $adjuntos,
					'esta' => array('' => '-- Seleccione Estado --') + 	\DB::table('estados')->whereIn('id', [2, 3])->lists('nombre','id'),
		 			'active_principal' => '',
		 			'active_validar' => 'active',
		 			'active_convalidar' => '',
		 			'active_reporte' => '',
		 			'active_class_alumno'=>'',
		 			'active_class_cuadro'=>'',
		 			'active_class_memorando'=>'',
		 			'active_estado' => '',
		 			'postulante' => $postulante,
		 			'solicitu' => $solicitud,
		 			'cursos_solicitud' => $curso_usua,
		 			'ciclos' => array('-- Seleccione Ciclo --') + CicloUPCI::lists('nombre', 'id'),
		 			'cursos_upci' => array('0' => '-- Seleccione Curso --'),
		 			'cuadro'=> $cuadro_lista
 					];



 			/* De acuerdo al codigo de postulante se consulta el id del expediente*/
		$id_expediente = \DB::table('expedientes')->where('postulante_id', Request::input('id_pos_grabar') )->pluck('id');

		$id_solicitud = \DB::table('solicitud_postulantes')->where('postulante_id', Request::input('cod_pos_grabar') )->pluck('id');

		$cuadro = New CuadroConvalidacionPostulantes();
		$cuadro->nota_curso_upci = Request::input('nota_upci');
		$cuadro->nota_curso_institucion = Request::input('nota_instituto');
		$cuadro->solicitud_postulantes = $id_solicitud ;
		$cuadro->curso_solipos_id = Request::input('cursos_institucion');
		$cuadro->curso_carrera_upci_id = Request::input('cursos_upci');
		$cuadro->expediente_id = $id_expediente;
		$cuadro->save();
 					
 					
 		//return redirect('comision/convalidar/show', Request::input('cod_pos_grabar'));
 		//return redirect('comision/convalidar')->with('cod_postu', Request::input('cod_pos_grabar'));
 		//return view('comision/convalidar/show', array('cod_postu' => Request::input('cod_pos_grabar') )) ;
 		//return view('comision/convalidar', $data);
		//return redirect('comision/convalidar')->with('cod_postu', Request::input('cod_pos_grabar'));
		return redirect()->action('Comision\ConvalidarController@index', Request::input('cod_pos_grabar'));
	}

	public function show($cod_postu){

		    //obtego el codigo del usuario del postulante, para realizar la carga de información
			$postulante = \DB::table('postulantes')->where('codigo', $cod_postu)->first();

			//obtengo las careras de la solicitud del usuario
			$solicitud = SolicitudPostulante::join('postulantes','solicitud_postulantes.postulante_id','=','postulantes.codigo')
							->join('users','postulantes.usuario_id','=','users.id')
							->join('carrera_instituciones','solicitud_postulantes.carrera_instit_id','=','carrera_instituciones.id')
							->join('instituciones','solicitud_postulantes.instituciones_id','=','instituciones.id')
							->join('carrera_upci','solicitud_postulantes.carrera_upci_id','=','carrera_upci.id')
							->where('postulantes.codigo','=', $cod_postu)
							->selectRaw('solicitud_postulantes.id as id, carrera_upci.nombre as nombre_ca_upci, 
								carrera_instituciones.nombre as nombre_ca_inst, instituciones.nombre as nombre_inst')
							->get('id','nombre_ca_upci','nombre_ca_inst', 'nombre_ca_upci','nombre_inst');
							
							//dd($solicitud);
							//dd(\DB::table('documentacion')->get());
			
			$adjuntos = Documentacion::join('solicitud_postulantes','documentacion.solicitud_id','=' ,'solicitud_postulantes.id')
							->join('postulantes','solicitud_postulantes.postulante_id','=','postulantes.codigo')
							->join('tipo_documentos','documentacion.tipo_id','=','tipo_documentos.id')
							->where('postulantes.codigo','=', $cod_postu)
							->selectRaw("tipo_documentos.nombre as tipo, documentacion.nombre_actual as nombre, DATE_FORMAT(documentacion.created_at,'%d %b %Y %T') as fecha")
							->get('tipo','nombre','fecha');

			//obtengo los cursos que ha registrado el usuario
			$curso_usua = SolicitudPostulante::join('cursos_solicitud_postulantes', 'solicitud_postulantes.id', '=', 'cursos_solicitud_postulantes.solicitud_id')
					->join('curso_instituciones', 'cursos_solicitud_postulantes.curso_institucion_id', '=', 'curso_instituciones.id' )
					->join('postulantes','solicitud_postulantes.postulante_id', '=', 'postulantes.codigo')
					->where('postulantes.codigo', '=', $cod_postu )
					->selectRaw('cursos_solicitud_postulantes.id as id, curso_instituciones.nombre as nombre, cursos_solicitud_postulantes.horas as horas, cursos_solicitud_postulantes.nota as nota')
					->get('id','nombre','horas','nota');

			$id_soli_postulante = \DB::table('solicitud_postulantes')->where('postulante_id', $cod_postu)->first();

			$cuadro_lista = CuadroConvalidacionPostulantes::join('curso_carrera_upci','cuadro_convalidacion_postulantes.curso_carrera_upci_id','=','curso_carrera_upci.id')
								->join('cursos_solicitud_postulantes','cuadro_convalidacion_postulantes.curso_solipos_id','=','cursos_solicitud_postulantes.id')
								->join('curso_instituciones','cursos_solicitud_postulantes.curso_institucion_id','=','curso_instituciones.id')
								->join('ciclo_upci','curso_carrera_upci.ciclo_upci_id','=','ciclo_upci.id')
								->where('cuadro_convalidacion_postulantes.solicitud_postulantes','=',$id_soli_postulante->id)
								->selectRaw('cuadro_convalidacion_postulantes.id as id, ciclo_upci.abreviatura as ciclo,
									curso_carrera_upci.codigo as codigo_curso_upci,
									curso_carrera_upci.nombre as nombre_curso_upci,
									curso_carrera_upci.creditos as creditos,
									curso_carrera_upci.hora_teorica as hora_teorica,
									curso_carrera_upci.hora_practica as hora_practica,
									curso_carrera_upci.th as th,
									cuadro_convalidacion_postulantes.nota_curso_upci as nota_curso_upci,
									(
									select cur_i.nombre from curso_instituciones cur_i where cur_i.id = 
									(select cusp.curso_institucion_id from cursos_solicitud_postulantes cusp where cusp.id=
									(select cua_c.curso_solipos_id from cuadro_convalidacion_postulantes cua_c where cua_c.id=cuadro_convalidacion_postulantes.id)
									)

									) as nombre_curso_i,
									cursos_solicitud_postulantes.horas as hora_curso_i,
									cuadro_convalidacion_postulantes.nota_curso_institucion as nota_curso_i, 
									cuadro_convalidacion_postulantes.solicitud_postulantes as cod_soli_pos')
								->orderBy('cuadro_convalidacion_postulantes.created_at','desc')
								->get('id','ciclo','codigo_curso_upci','nombre_curso_upci','creditos','hora_teorica','hora_practica','th','nota_curso_upci','nombre_curso_i',
									'hora_curso_i','nota_curso_i','cod_soli_pos');

			$data = ['var_doc'=> $adjuntos,
					'esta' => array('' => '-- Seleccione Estado --') + 	\DB::table('estados')->whereIn('id', [2, 3])->lists('nombre','id'),
		 			'active_principal' => '',
		 			'active_validar' => 'active',
		 			'active_convalidar' => '',
		 			'active_reporte' => '',
		 			'active_class_alumno'=>'',
		 			'active_class_cuadro'=>'',
		 			'active_class_memorando'=>'',
		 			'active_estado' => '',
		 			'postulante' => $postulante,
		 			'solicitu' => $solicitud,
		 			'cursos_solicitud' => $curso_usua,
		 			'ciclos' => array('-- Seleccione Ciclo --') + CicloUPCI::lists('nombre', 'id'),
		 			'cursos_upci' => array('0' => '-- Seleccione Curso --'),
		 			//'cuadro'=> \DB::table('listado_cuadro_convalidacion')->where('cod_soli_pos', $id_soli_postulante->id)->get(),
		 			'cuadro'=> $cuadro_lista
 					];
 					
 			//dd($data);
 			return view('comision/convalidar', $data);

	}

	public function adjunto($codigo){

		if (Request::ajax())
		{
		    return response()->json([ 
		    	'r'=> '<object data="/adjuntos/'.$codigo.'#toolbar=1&amp;navpanes=1&amp;scrollbar=1&amp;page=5&amp;view=FitH&amp;zoom=75" type="application/pdf" width="100%" height="500px"> <param name="zoom" value="10%" /></object> <br /><a href="/adjuntos/'.$codigo.'" target="_blank">Abrir en Nueva Ventana</a>'
		    	]);
		} else {
			return "Error";
		}


	}

}
