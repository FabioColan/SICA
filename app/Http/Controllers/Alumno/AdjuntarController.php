<?php namespace App\Http\Controllers\Alumno;

use Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Bican\Roles\Models\Role;
use App\Estados;
use App\Http\Requests\AdjuntosRequest;
use Input;
use Validator;
use Redirect;
use Session;
use Auth;
use App\Notificaciones;
use App\SolicitudPostulante;
use App\CursoInstituciones;
use App\Documentacion;
use App\Expedientes;


class AdjuntarController extends Controller {

	public function __construct()
	{
		$this->middleware('auth');
	}


	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
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

		
		//dd($estad);
		if (empty($estado_id)) {
			
			return redirect('/solicitar');

		} else {
				

				/**se valida si el estado del expediente es nulo
				* en caso de ser nulo se procede a devolver la logica normal, mostrar según el estado de la solicitu
				* caso contrario se mostrará según el estado del expediente, se mostrará solamente en el estado incompleto
				*/

				$id_postulante = \DB::table('postulantes')->where('usuario_id',$id)->pluck('id');

				$id_expediente_estado = \DB::table('expedientes')->where('postulante_id', $id_postulante)->pluck('estado_id');

				if ((is_null($id_expediente_estado) or empty($id_expediente_estado))) {


						$estad = $estado_id[0];
						

						if ($estad == 7){
							
							return redirect('/');	

						} elseif ($estad == 5 ){

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

							$data = ['active_principal' => '',
								 'active_notificacion' => '',
								 'active_solicitar' => '',
								 'active_class_solicitar'=>'',
								 'active_class_ampliar'=>'',
								 'active_adjuntar' => 'active',
								 'active_estado' => '',
								 ];
							return view('alumno/adjuntar', $data);

						}  else {

							return "error no controlado aún";
						}

				} elseif ($id_expediente_estado == 2){ //incompleto

					//se muestra la vista para que adjunten
					return redirect('show/completar');

				} elseif ($id_expediente_estado == 1){ //en proceso

					//se muestra las notificaciones
					return redirect('/notificacion');	

				} elseif (($id_expediente_estado == 3)){ //completo

					//se muestra las notificaciones
					return redirect('/notificacion');
				}

		} 

	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function grabar()
	{

		//Se obtiene el id del usuario actual
		$id = Auth::user()->id;

		  // getting all of the post data
		  $file = array('silabo'		=> Input::file('Silabos'),
		  				'certificado' 	=> Input::file('Certificado_de_Estudios'),
		  				'titulo' 		=> Input::file('Titulo_Profesional'),
		  				'opcional' 		=> Input::file('Opcional')
		  				);
		  // setting up rules
		  $rules = array('silabo' 		=> 'required|mimes:jpeg,bmp,png,pdf|max:10000',
		  				 'certificado' 	=> 'required|mimes:jpeg,bmp,png,pdf|max:10000',
		  				 'titulo' 		=> 'required|mimes:jpeg,bmp,png,pdf|max:10000',
		  				 'opcional' 	=> 'mimes:jpeg,bmp,png,pdf|max:10000'
		  				); //mimes:jpeg,bmp,png and for max size max:10000

		  // doing the validation, passing post data, rules and the messages
		  $validator = Validator::make($file, $rules);
		  if ($validator->fails()) {
		    // send back to the page with the input data and errors
		    return Redirect::to('show/adjuntos')->withInput()->withErrors($validator);

		  }
		  else {
		    // checking file is valid.
		    if (Input::hasFile('Opcional') == true) 
		    {

		    	if (Input::hasFile('Silabos') == true and Input::hasFile('Certificado_de_Estudios') == true
		    		and Input::hasFile('Titulo_Profesional') == true) {
		      
		      //obtengo el codigo de solicitud del usuario
			  $id_solicitud = SolicitudPostulante::join('postulantes','solicitud_postulantes.postulante_id','=','postulantes.codigo')
							->join('users','postulantes.usuario_id','=','users.id')
							->where('postulantes.usuario_id','=', $id)
							->selectRaw('solicitud_postulantes.id as id')
							->lists('id');

		      $destinationPath = 'adjuntos'; // upload path
		      $extension = Input::file('Silabos')->getClientOriginalExtension(); // getting image extension
		      $nombre = Input::file('Silabos')->getClientOriginalName(); // getting image extension
		      $fileName = 's'.rand(11111,99999).'u'.$id.'.'.$extension; // renameing image
		      Input::file('Silabos')->move($destinationPath, $fileName); // uploading file to given path
		      // sending back with message
		      Session::flash('success', 'Upload successfully'); 
		      //return Redirect::to('/');

			     //se graba cada documento
					      $documentacion = New Documentacion();
					      $documentacion->nombre_original = $nombre;
					      $documentacion->nombre_actual = $fileName;
					      $documentacion->ruta = '/adjuntos' ;
					      $documentacion->solicitud_id = $id_solicitud[0];
					      $documentacion->tipo_id = 1;
						  $documentacion->save();


			      $destinationPath = 'adjuntos'; // upload path
			      $extension = Input::file('Certificado_de_Estudios')->getClientOriginalExtension(); // getting image extension
			      $nombre = Input::file('Certificado_de_Estudios')->getClientOriginalName(); // getting image extension
		      	  $fileName = 'c'.rand(11111,99999).'u'.$id.'.'.$extension; // renameing image
			      Input::file('Certificado_de_Estudios')->move($destinationPath, $fileName); // uploading file to given path
			      // sending back with message
			      Session::flash('success', 'Upload successfully'); 
			      //return Redirect::to('/');
			      	  
			      	  	  //se graba cada documento
					      $documentacion = New Documentacion();
					      $documentacion->nombre_original = $nombre;
					      $documentacion->nombre_actual = $fileName;
					      $documentacion->ruta = '/adjuntos' ;
					      $documentacion->solicitud_id = $id_solicitud[0];
					      $documentacion->tipo_id = 2;
						  $documentacion->save();

			      	
				      $destinationPath = 'adjuntos'; // upload path
				      $extension = Input::file('Titulo_Profesional')->getClientOriginalExtension(); // getting image extension
				      $nombre = Input::file('Titulo_Profesional')->getClientOriginalName(); // getting image extension
		      	      $fileName = 't'.rand(11111,99999).'u'.$id.'.'.$extension; // renameing image
				      Input::file('Titulo_Profesional')->move($destinationPath, $fileName); // uploading file to given path
				      // sending back with message
				      Session::flash('success', 'Upload successfully'); 
				      

				      	//se graba cada documento
					      $documentacion = New Documentacion();
					      $documentacion->nombre_original = $nombre;
					      $documentacion->nombre_actual = $fileName;
					      $documentacion->ruta = '/adjuntos' ;
					      $documentacion->solicitud_id = $id_solicitud[0];
					      $documentacion->tipo_id = 3;
						  $documentacion->save();


					  $destinationPath = 'adjuntos'; // upload path
				      $extension = Input::file('Opcional')->getClientOriginalExtension(); // getting image extension
				      $nombre = Input::file('Opcional')->getClientOriginalName(); // getting image extension
		      	      $fileName = 'o'.rand(11111,99999).'u'.$id.'.'.$extension; // renameing image
				      Input::file('Opcional')->move($destinationPath, $fileName); // uploading file to given path
				      // sending back with message
				      Session::flash('success', 'Upload successfully'); 
				      	

				      		//se graba cada documento
						      $documentacion = New Documentacion();
						      $documentacion->nombre_original = $nombre;
						      $documentacion->nombre_actual = $fileName;
						      $documentacion->ruta = '/adjuntos' ;
						      $documentacion->solicitud_id = $id_solicitud[0];
						      $documentacion->tipo_id = 4;
							  $documentacion->save();

				      //Se obtiene el id del usuario actual
						$id = Auth::user()->id;

						$postulante_id = SolicitudPostulante::join('postulantes','solicitud_postulantes.postulante_id','=','postulantes.codigo')
							->join('users', 'postulantes.usuario_id','=','users.id')
							->where('postulantes.usuario_id', $id)
							->selectRaw('solicitud_postulantes.id as id')
							->lists('id');

					 //Se establece el valor del estado
				      $estado = 7;
					  $user = SolicitudPostulante::find($postulante_id[0]);
					  $user->estado_id = $estado;
					  $user->save();
					  
					  //se graba la notificaion
				      $notificacion = New Notificaciones();
				      $notificacion->descripcion = 'Se ha recibido los archivos adjuntos.';
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

				      return Redirect::to('/notificacion');
		    	
		    		} else {

				    	// sending back with error message.
				      Session::flash('error', 'uploaded file is not valid');
				      return Redirect::to('show/adjuntos');
				    }
				      
		    } else {

		    	if (Input::hasFile('Silabos') == true and Input::hasFile('Certificado_de_Estudios') == true
		    	and Input::hasFile('Titulo_Profesional') == true) {
		      
		      //obtengo el codigo de solicitud del usuario
			  $id_solicitud = SolicitudPostulante::join('postulantes','solicitud_postulantes.postulante_id','=','postulantes.codigo')
							->join('users','postulantes.usuario_id','=','users.id')
							->where('postulantes.usuario_id','=', $id)
							->selectRaw('solicitud_postulantes.id as id')
							->lists('id');

		      $destinationPath = 'adjuntos'; // upload path
		      $extension = Input::file('Silabos')->getClientOriginalExtension(); // getting image extension
		      $nombre = Input::file('Silabos')->getClientOriginalName(); // getting image extension
		      $fileName = 's'.rand(11111,99999).'u'.$id.'.'.$extension; // renameing image
		      Input::file('Silabos')->move($destinationPath, $fileName); // uploading file to given path
		      // sending back with message
		      Session::flash('success', 'Upload successfully'); 
		      //return Redirect::to('/');

			     //se graba cada documento
					      $documentacion = New Documentacion();
					      $documentacion->nombre_original = $nombre;
					      $documentacion->nombre_actual = $fileName;
					      $documentacion->ruta = '/adjuntos' ;
					      $documentacion->solicitud_id = $id_solicitud[0];
					      $documentacion->tipo_id = 1;
						  $documentacion->save();


			      $destinationPath = 'adjuntos'; // upload path
			      $extension = Input::file('Certificado_de_Estudios')->getClientOriginalExtension(); // getting image extension
			      $nombre = Input::file('Certificado_de_Estudios')->getClientOriginalName(); // getting image extension
		      	  $fileName = 'c'.rand(11111,99999).'u'.$id.'.'.$extension; // renameing image
			      Input::file('Certificado_de_Estudios')->move($destinationPath, $fileName); // uploading file to given path
			      // sending back with message
			      Session::flash('success', 'Upload successfully'); 
			      //return Redirect::to('/');
			      	  
			      	  	  //se graba cada documento
					      $documentacion = New Documentacion();
					      $documentacion->nombre_original = $nombre;
					      $documentacion->nombre_actual = $fileName;
					      $documentacion->ruta = '/adjuntos' ;
					      $documentacion->solicitud_id = $id_solicitud[0];
					      $documentacion->tipo_id = 2;
						  $documentacion->save();

			      	
				      $destinationPath = 'adjuntos'; // upload path
				      $extension = Input::file('Titulo_Profesional')->getClientOriginalExtension(); // getting image extension
				      $nombre = Input::file('Titulo_Profesional')->getClientOriginalName(); // getting image extension
		      	      $fileName = 't'.rand(11111,99999).'u'.$id.'.'.$extension; // renameing image
				      Input::file('Titulo_Profesional')->move($destinationPath, $fileName); // uploading file to given path
				      // sending back with message
				      Session::flash('success', 'Upload successfully'); 
				      

				      	//se graba cada documento
					      $documentacion = New Documentacion();
					      $documentacion->nombre_original = $nombre;
					      $documentacion->nombre_actual = $fileName;
					      $documentacion->ruta = '/adjuntos' ;
					      $documentacion->solicitud_id = $id_solicitud[0];
					      $documentacion->tipo_id = 3;
						  $documentacion->save();

				      //Se obtiene el id del usuario actual
						$id = Auth::user()->id;

						$postulante_id = SolicitudPostulante::join('postulantes','solicitud_postulantes.postulante_id','=','postulantes.codigo')
							->join('users', 'postulantes.usuario_id','=','users.id')
							->where('postulantes.usuario_id', $id)
							->selectRaw('solicitud_postulantes.id as id')
							->lists('id');

					 //Se establece el valor del estado
				      $estado = 7;
					  $user = SolicitudPostulante::find($postulante_id[0]);
					  $user->estado_id = $estado;
					  $user->save();
					  
					  //se graba la notificaion
				      $notificacion = New Notificaciones();
				      $notificacion->descripcion = 'Se ha recibido los archivos adjuntos.';
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

				      return Redirect::to('/notificacion');
		    	
		    		} else {

				    	// sending back with error message.
				      Session::flash('error', 'uploaded file is not valid');
				      return Redirect::to('show/adjuntos');

				    }

		    }
		  }
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
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
		
		/**se valida si el estado del expediente es nulo
		* en caso de ser nulo se procede a devolver la logica normal, mostrar según el estado de la solicitu
		* caso contrario se mostrará según el estado del expediente, se mostrará solamente en el estado incompleto
		*/

		$id_postulante = \DB::table('postulantes')->where('usuario_id',$id)->pluck('id');

		$id_expediente_estado = \DB::table('expedientes')->where('postulante_id', $id_postulante)->pluck('estado_id');

		if ((is_null($id_expediente_estado) or empty($id_expediente_estado))) {

				//dd($estad);
				if (is_null($estado_id)) {
					
					return redirect('/solicitar');

				} elseif ($estad == 7){
						
					return redirect('/');	

				} elseif ($estad == 5 ){

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

					$data = ['active_principal' => '',
						 'active_notificacion' => '',
						 'active_solicitar' => '',
						 'active_class_solicitar'=>'',
						 'active_class_ampliar'=>'',
						 'active_adjuntar' => 'active',
						 'active_estado' => '',
						 ];
					return view('alumno/adjuntar', $data);

				}  else {

					return "error no controlado aún";
				}

			} elseif ($id_expediente_estado == 2){

					//se muestra la vista para que adjunten
				return redirect('show/completar');

			} elseif ($id_expediente_estado == 1){
				
					//se muestra la vista para que adjunten
				return redirect('/notificacion');			

			} elseif (($id_expediente_estado == 3)){ //completo

					//se muestra las notificaciones
					return redirect('/notificacion');
			}
		

	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function showCompletar()
	{
		
		//Se obtiene el id del usuario actual
		$id = Auth::user()->id;

		/*Se obtiene los documentos adjuntos*/
		$adjuntos = Documentacion::join('solicitud_postulantes','documentacion.solicitud_id','=' ,'solicitud_postulantes.id')
							->join('postulantes','solicitud_postulantes.postulante_id','=','postulantes.codigo')
							->where('postulantes.usuario_id','=', $id)
							->selectRaw('documentacion.nombre_actual as nombre, documentacion.created_at as fecha, documentacion.id as id ')
							->get('id','nombre','fecha');


		$data = ['var_doc'=> $adjuntos,
				'active_principal' => '',
				 'active_notificacion' => '',
				 'active_solicitar' => '',
				 'active_class_solicitar'=>'',
				 'active_class_ampliar'=>'',
				 'active_adjuntar' => 'active',
				 'active_estado' => ''
					];
	
			return view('alumno/completar', $data);

	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function grabarAdicional()
	{
		
		//Se obtiene el id del usuario actual
		$id = Auth::user()->id;

		  // getting all of the post data
		  $file = array('archivo_adicional'		=> Input::file('Archivo_Adicional')
		  				);
		  // setting up rules
		  $rules = array('archivo_adicional' 		=> 'required|mimes:pdf|max:10000',
		  				); //mimes:jpeg,bmp,png and for max size max:10000

		  // doing the validation, passing post data, rules and the messages
		  $validator = Validator::make($file, $rules);
		  if ($validator->fails()) {
		    // send back to the page with the input data and errors
		    return Redirect::to('show/completar')->withInput()->withErrors($validator);

		  }
		  else {
		    // checking file is valid.
		    if (Input::hasFile('Archivo_Adicional') == true) 
		    {
		      
		      //obtengo el codigo de solicitud del usuario
			  $id_solicitud = SolicitudPostulante::join('postulantes','solicitud_postulantes.postulante_id','=','postulantes.codigo')
							->join('users','postulantes.usuario_id','=','users.id')
							->where('postulantes.usuario_id','=', $id)
							->selectRaw('solicitud_postulantes.id as id')
							->lists('id');

		      $destinationPath = 'adjuntos'; // upload path
		      $extension = Input::file('Archivo_Adicional')->getClientOriginalExtension(); // getting image extension
		      $nombre = Input::file('Archivo_Adicional')->getClientOriginalName(); // getting image extension
		      $fileName = 's'.$nombre.rand(11111,99999).'u'.$id.'.'.$extension; // renameing image
		      Input::file('Archivo_Adicional')->move($destinationPath, $fileName); // uploading file to given path
		      // sending back with message
		      Session::flash('success', 'Upload successfully'); 
		      //return Redirect::to('/');

			  //se graba cada documento
		      $documentacion = New Documentacion();
		      $documentacion->nombre_original = $nombre;
		      $documentacion->nombre_actual = $fileName;
		      $documentacion->ruta = '/adjuntos' ;
		      $documentacion->solicitud_id = $id_solicitud[0];
		      $documentacion->tipo_id = 4;
		      $documentacion->save();

			  //se graba la notificaion
		      $notificacion = New Notificaciones();
		      $notificacion->descripcion = 'Se adicionó el archivo: '.$fileName;
		      $notificacion->usuario_id = $id;
		      $notificacion->estado_id = 2;
		      $notificacion->save();

		      $data = ['mensaje' => $notificacion->descripcion];
		      \Mail::send('mail', $data, function($message)
		      {	
		      	$email = Auth::user()->email;
		      	$name = Auth::user()->name;
		      	$message->to($email, $name)->subject('SICA - UNIVERSIDAD PERUANA DE CIENCIAS E INFORMÁTICA');

		      });		

		      return Redirect::to('show/completar');

		    } else {

				    	// sending back with error message.
				      Session::flash('error', 'uploaded file is not valid');
				      return Redirect::to('show/adjuntos');

			}		 
		}

	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */

	public function enviarAdicional(Request $request)
	{
		//Se obtiene el id del usuario actual
		$id = Auth::user()->id;

		$id_postulante = \DB::table('postulantes')->where('usuario_id',$id)->pluck('id');

		$id_expediente = \DB::table('expedientes')->where('postulante_id',$id_postulante)->pluck('id');

		//crear expediente con la relacionanado al postulante con la comision
		$expediente = Expedientes::find($id_expediente);
		$expediente->estado_id=1;
		$expediente->save();

		//se graba la notificaion
		$notificacion = New Notificaciones();
		$notificacion->descripcion = 'Se envió la documentación modificada. Siga pendiente de las instrucciones.';
		$notificacion->usuario_id = $id;
		$notificacion->estado_id = 2;
		$notificacion->save();

		$data = ['mensaje' => $notificacion->descripcion];
		\Mail::send('mail', $data, function($message)
		{	
			$email = Auth::user()->email;
			$name = Auth::user()->name;
			$message->to($email, $name)->subject('SICA - UNIVERSIDAD PERUANA DE CIENCIAS E INFORMÁTICA');

		});		

		return redirect('/notificacion');

	}

	public function delete($id, Request $request){

		$docum = Documentacion::find($id);
		$docum->delete();

		$mensaje = "El curso ".$id." fue eliminado satisfactoriamente.";

		if ($request->ajax())
		{
		    return $mensaje;
		}

		Session::flash('message', $mensaje);
		return redirect('show/completar');
	}

}
