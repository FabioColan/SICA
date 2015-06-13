<?php namespace App\Http\Controllers\Comision;

use App\Http\Controllers\Controller;
use Bican\Roles\Models\Role;
use App\User;
use Auth;	
use App\Estados;
use App\Instituciones;
use App\Postulantes;
use App\SolicitudPostulante;
use App\Documentacion;
use Request;
use Input;
use App\Expedientes;
use App\Notificaciones;
use Validator;
use Redirect;

class ValidarController extends Controller {

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
							->selectRaw('tipo_documentos.nombre as tipo, documentacion.nombre_actual as nombre, documentacion.created_at as fecha ')
							->get('tipo','nombre','fecha');

			

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
		 			'solicitu' => $solicitud
 					];
		
 			return view('comision/validar', $data);

		} 
		else {

			return 'No autorizado';
		
		}

	}


	public function validar(Request $request){

		//Se obtiene el id del usuario actual
		$id = Auth::user()->id;

		// getting all of the post data
		$campos = array('estado'				=> Request::input('estado'),
			'codigo_postulante' 	=> Request::input('codigo_postulante'),
			'mensaje' 				=> Request::input('mensaje'),
			);

		  //obtengo el id del docente que esta realizando labores de comisión
		$id_comision = \DB::table('comision')->where('usuario_id',$id)->pluck('id');

		//obtengo los datos del formulario para grabarlos en el expediente
		$estado 			= Request::input('estado');
		$cod_postulante 	= Request::input('codigo_postulante');
		$mensaje			= Request::input('mensaje');

		//de acuerdo al codigo de postulante recibido, se obtiene el id respectivo para grabarlo en el expediente
		$id_postulante = \DB::table('postulantes')->where('codigo',$cod_postulante)->pluck('id');

		//consulta el id del usuario segun el codigo de postulante
		$id_usuario_postulante = \DB::table('postulantes')->where('codigo',$cod_postulante)->pluck('usuario_id');

		  // setting up rules
		  $rules = array('estado' 				=> 'required',
		  				 'codigo_postulante' 	=> 'required',
		  				 'mensaje' 				=> 'required'
		  				); //mimes:jpeg,bmp,png and for max size max:10000

		  $messages = array(
			    'required' => 'El :attribute es necesario para continuar.',
			);
		  // doing the validation, passing post data, rules and the messages
		  $validator = Validator::make($campos, $rules, $messages);
		  if ($validator->fails()) {
		    // send back to the page with the input data and errors
		    //return view('comision/validar')->withInput()->withErrors($validator);
		    return Redirect::back()->withInput()->withErrors($validator);

		  }
		  else {

						if ($estado==2) //Incompleto
						{	

							/* De acuerdo al codigo de postulante se consulta el id del expediente*/
							$id_expediente = \DB::table('expedientes')->where('postulante_id',$id_postulante)->pluck('id');

							if (is_null($id_expediente) or empty($id_expediente)){

								//crear expediente con la relacionanado al postulante con la comision
								$expediente = New Expedientes();
								$expediente->postulante_id = $id_postulante;
								$expediente->comision_id= $id_comision;
								$expediente->estado_id=$estado;
								$expediente->save();

								//Se notitica al postulante que ha iniciado el proceso de verificación y convalidación
								/*Estado=1 --En proceso*/
								$notificacion = New Notificaciones();
							    $notificacion->descripcion = 'Convalidación en proceso. Siga pendiente de las instrucciones. '.$mensaje;
							    $notificacion->usuario_id = $id_usuario_postulante;
							    $notificacion->estado_id = 1;
								$notificacion->save();

								$data = ['mensaje' => $notificacion->descripcion];
								\Mail::send('mail', $data, function($message)
								{	

									//obtengo el codigo de postulante enviado en la consulta
									$cod_postulante 	= Request::input('codigo_postulante');

									//consulta el id del usuario segun el codigo de postulante
									$id_usuario_postulante = \DB::table('postulantes')->where('codigo',$cod_postulante)->pluck('usuario_id');

									//obtengo el correo del postulante
									$correo_postulante = \DB::table('users')->where('id',$id_usuario_postulante)->pluck('email');

									//obtengo el nombre del postulante
									$nombre_postulante = \DB::table('users')->where('id', $id_usuario_postulante)->pluck('name');

									//se envia el correo
									$message->to($correo_postulante, $nombre_postulante)->subject('SICA - UNIVERSIDAD PERUANA DE CIENCIAS E INFORMÁTICA');

								});		

								/* De acuerdo al codigo de postulante se consulta el id del expediente*/
								$id_expediente_n = \DB::table('expedientes')->where('postulante_id',$id_postulante)->pluck('id');
								//crear expediente con la relacionanado al postulante con la comision
								$expediente = Expedientes::find($id_expediente_n);
								$expediente->estado_id=2;
								$expediente->save();

								//Se notitica al postulante que su documentación está incompleta
								/*Estado=2 --Incompleto*/
								$notificacion = New Notificaciones();
							    $notificacion->descripcion = 'Lamentablemente su documentación esta incompleta. Vaya a la opción Adjuntar Documentos. '.$mensaje;
							    $notificacion->usuario_id = $id_usuario_postulante;
							    $notificacion->estado_id = 2;
								$notificacion->save();

								$data = ['mensaje' => $notificacion->descripcion];
								\Mail::send('mail', $data, function($message)
								{	
									//obtengo el codigo de postulante enviado en la consulta
									$cod_postulante 	= Request::input('codigo_postulante');

									//consulta el id del usuario segun el codigo de postulante
									$id_usuario_postulante = \DB::table('postulantes')->where('codigo',$cod_postulante)->pluck('usuario_id');

									//obtengo el correo del postulante
									$correo_postulante = \DB::table('users')->where('id',$id_usuario_postulante)->pluck('email');

									//obtengo el nombre del postulante
									$nombre_postulante = \DB::table('users')->where('id', $id_usuario_postulante)->pluck('name');

									//se envia el correo
									$message->to($correo_postulante, $nombre_postulante)->subject('SICA - UNIVERSIDAD PERUANA DE CIENCIAS E INFORMÁTICA');

								});		

								return redirect('/');

							} else {

								//crear expediente con la relacionanado al postulante con la comision
								$expediente = Expedientes::find($id_expediente);
								$expediente->estado_id=2;
								$expediente->save();

								//Se notitica al postulante que su documentación está incompleta
								/*Estado=2 --Incompleto*/
								$notificacion = New Notificaciones();
							    $notificacion->descripcion = 'Lamentablemente su documentación esta incompleta. Vaya a la opción Adjuntar Documentos. '.$mensaje;
							    $notificacion->usuario_id = $id_usuario_postulante;
							    $notificacion->estado_id = 2;
								$notificacion->save();

								


								$data = ['mensaje' => $notificacion->descripcion];
								\Mail::send('mail', $data, function($message)
								{	
									//obtengo el codigo de postulante enviado en la consulta
									$cod_postulante 	= Request::input('codigo_postulante');

									//consulta el id del usuario segun el codigo de postulante
									$id_usuario_postulante = \DB::table('postulantes')->where('codigo',$cod_postulante)->pluck('usuario_id');

									//obtengo el correo del postulante
									$correo_postulante = \DB::table('users')->where('id',$id_usuario_postulante)->pluck('email');

									//obtengo el nombre del postulante
									$nombre_postulante = \DB::table('users')->where('id', $id_usuario_postulante)->pluck('name');

									//se envia el correo
									$message->to($correo_postulante, $nombre_postulante)->subject('SICA - UNIVERSIDAD PERUANA DE CIENCIAS E INFORMÁTICA');

								});		

								return redirect('/');

							}

						} elseif ($estado==3) //Completo
						{

							/* De acuerdo al codigo de postulante se consulta el id del expediente*/
							$id_expediente = \DB::table('expedientes')->where('postulante_id',$id_postulante)->pluck('id');

							if (is_null($id_expediente) or empty($id_expediente)){

								//crear expediente con la relacionanado al postulante con la comision
								$expediente = New Expedientes();
								$expediente->postulante_id = $id_postulante;
								$expediente->comision_id= $id_comision;
								$expediente->estado_id=$estado;
								$expediente->save();

								//Se notitica al postulante que ha iniciado el proceso de verificación y convalidación
								/*Estado=1 --En proceso*/
								$notificacion = New Notificaciones(); 
							    $notificacion->descripcion = 'Convalidación en proceso. Siga pendiente de las instrucciones. '.$mensaje;
							    $notificacion->usuario_id = $id_usuario_postulante;
							    $notificacion->estado_id = 1;
								$notificacion->save();

								$data = ['mensaje' => $notificacion->descripcion];
								\Mail::send('mail', $data, function($message)
								{	
									//obtengo el codigo de postulante enviado en la consulta
									$cod_postulante 	= Request::input('codigo_postulante');

									//consulta el id del usuario segun el codigo de postulante
									$id_usuario_postulante = \DB::table('postulantes')->where('codigo',$cod_postulante)->pluck('usuario_id');

									//obtengo el correo del postulante
									$correo_postulante = \DB::table('users')->where('id',$id_usuario_postulante)->pluck('email');

									//obtengo el nombre del postulante
									$nombre_postulante = \DB::table('users')->where('id', $id_usuario_postulante)->pluck('name');

									//se envia el correo
									$message->to($correo_postulante, $nombre_postulante)->subject('SICA - UNIVERSIDAD PERUANA DE CIENCIAS E INFORMÁTICA');

								});		

								/* De acuerdo al codigo de postulante se consulta el id del expediente*/
								$id_expediente_o = \DB::table('expedientes')->where('postulante_id',$id_postulante)->pluck('id');

								//crear expediente con la relacionanado al postulante con la comision
								$expediente = Expedientes::find($id_expediente_o);
								$expediente->estado_id=3;
								$expediente->save();

								//Se notitica al postulante que su documentación está incompleta
								/*Estado=2 --Incompleto*/
								$notificacion = New Notificaciones();
							    $notificacion->descripcion = 'Su documentación fue revisada y esta completa. Siga pendiente de las instrucciones. '.$mensaje;
							    $notificacion->usuario_id = $id_usuario_postulante;
							    $notificacion->estado_id = 3;
								$notificacion->save();

								$data = ['mensaje' => $notificacion->descripcion];
								\Mail::send('mail', $data, function($message)
								{	
									//obtengo el codigo de postulante enviado en la consulta
									$cod_postulante 	= Request::input('codigo_postulante');

									//consulta el id del usuario segun el codigo de postulante
									$id_usuario_postulante = \DB::table('postulantes')->where('codigo',$cod_postulante)->pluck('usuario_id');

									//obtengo el correo del postulante
									$correo_postulante = \DB::table('users')->where('id',$id_usuario_postulante)->pluck('email');

									//obtengo el nombre del postulante
									$nombre_postulante = \DB::table('users')->where('id', $id_usuario_postulante)->pluck('name');

									//se envia el correo
									$message->to($correo_postulante, $nombre_postulante)->subject('SICA - UNIVERSIDAD PERUANA DE CIENCIAS E INFORMÁTICA');

								});

								return redirect('/');

							} else {

								//crear expediente con la relacionanado al postulante con la comision
								$expediente = Expedientes::find($id_expediente);
								$expediente->estado_id=3;
								$expediente->save();

								//Se notitica al postulante que su documentación está incompleta
								/*Estado=2 --Incompleto*/
								$notificacion = New Notificaciones();
							    $notificacion->descripcion = 'Su documentación fue revisada y esta completa. Siga pendiente de las instrucciones. '.$mensaje;
							    $notificacion->usuario_id = $id_usuario_postulante;
							    $notificacion->estado_id = 3;
								$notificacion->save();

								$data = ['mensaje' => $notificacion->descripcion];
								\Mail::send('mail', $data, function($message)
								{	
									//obtengo el codigo de postulante enviado en la consulta
									$cod_postulante 	= Request::input('codigo_postulante');

									//consulta el id del usuario segun el codigo de postulante
									$id_usuario_postulante = \DB::table('postulantes')->where('codigo',$cod_postulante)->pluck('usuario_id');

									//obtengo el correo del postulante
									$correo_postulante = \DB::table('users')->where('id',$id_usuario_postulante)->pluck('email');

									//obtengo el nombre del postulante
									$nombre_postulante = \DB::table('users')->where('id', $id_usuario_postulante)->pluck('name');

									//se envia el correo
									$message->to($correo_postulante, $nombre_postulante)->subject('SICA - UNIVERSIDAD PERUANA DE CIENCIAS E INFORMÁTICA');

								});

								return redirect('/');
							}

						} else {
							return "Ha ocurrido un error, comunicarse con el administrador.";
						}

		  }

	}


	public function show($cod_postu){

	}

}
