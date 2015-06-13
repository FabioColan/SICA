<?php namespace App\Http\Controllers\Administrador;

use App\Http\Controllers\Controller;
use Bican\Roles\Models\Role;
use App\User;
use Auth;
use App\CursoInstituciones;
use App\Http\Requests\NuevoCursosCarrerasRequest;
use Input;
use Request;
use App\Http\Requests\EditCursoInstitucionesRequest;
use App\CarreraInstituciones;


class CursosInstitucionesController extends Controller {

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

			if ($user->is('admin')) 
			{

			
			$data = [
 					'cur_institu'=> \DB::table('curso_instituciones')->get(),
 					'active_principal' => '',
 					'active_usuario' => '',
 					'active_mantenimiento'=>'active',
 					'active_class_inst' => '',
 					'active_class_carr_inst'=>'',
 					'active_class_cur_inst' => 'active',
 					'active_class_moda' => '',
 					'active_class_facu_upci'=>'',
 					'active_class_carr_upci'=>'',
 					'active_class_plan_upci'=>'',
 					'active_class_cur_upci'=>'',
 					'active_class_cicl_upci'=>'',
 					'Carreras' => array('-- Seleccione Carrera --') + \DB::table('carrera_instituciones')->lists('nombre','id')
 					];
 					
 			return view('administrador/curso_instituciones', $data);

		} else {
					return view('no_autorizado');
			}

		}catch (Illuminate\Database\Eloquent\ModelNotFoundException $e) {
		     return Response::make('No encontrado', 404);
		}

	}

	public function nuevo(NuevoCursosCarrerasRequest $request)
	{
		try {

		//Se obtiene el id del usuario actual
		$id = Auth::user()->id;

			//Se obtiene el Usuario segùn el id encontrado
		$user = User::find($id);

			if ($user->is('admin')) 
			{


		//Se obtiene el id del usuario actual
		// $id = Auth::user()->id;
			
		//INSTITUCIONES NUEVO QUE SE INGRESARA PORQUE NO ESTA REGISTRADO, SE REGISTRA DIRECTO A LA TABLA MAESTRA
		$curso_carreras_nuevo = array(	
								'nombre'  =>Input::get('curso_nombre'),
								'credito'  =>Input::get('creditos_curso_nombre'),
								'horas'  =>Input::get('horas_curso_nombre'),
								'horas_teoicas'  =>Input::get('horas_teoricas_curso_nombre'),
								'horas_practicas'  =>Input::get('horas_practicas_curso_nombre'),
								'carrera_id' =>Input::get('carreras_tipo')
								);
		// dd($curso_carreras_nuevo);
		$cursocarreras = New CursoInstituciones($curso_carreras_nuevo);
		$cursocarreras->push();
		// $curso_carreras_nuevo->save();

		return redirect('show/curso_instituciones');

		} else {
					return view('no_autorizado');
			}

		}catch (Illuminate\Database\Eloquent\ModelNotFoundException $e) {
		     return Response::make('No encontrado', 404);
		}
	}

// FUNCION EDITAR INSTITUCIONES
	public function edit($id)
	{
		try {

		//Se obtiene el id del usuario actual
		$id = Auth::user()->id;

			//Se obtiene el Usuario segùn el id encontrado
		$user = User::find($id);

			if ($user->is('admin')) 
			{


		
		$data = ['Carreras' => CarreraInstituciones::lists('nombre','id'),
				'active_principal' => '',
 				'active_usuario' => '',
 				'active_mantenimiento'=>'active',
 				'active_class_inst' => '',
 				'active_class_carr_inst'=>'',
 				'active_class_cur_inst' => 'active',
 				'active_class_moda' => '',
 				'active_class_facu_upci'=>'',
 				'active_class_carr_upci'=>'',
 				'active_class_plan_upci'=>'',
 				'active_class_cur_upci'=>'',
 				'active_class_cicl_upci'=>'',
 				'cur_ins'=>CursoInstituciones::findOrFail($id)
 				];

		return view('administrador/curso_instituciones_edit', $data);
		//	return redirect ('show/instituciones');

		} else {
					return view('no_autorizado');
			}

		}catch (Illuminate\Database\Eloquent\ModelNotFoundException $e) {
		     return Response::make('No encontrado', 404);
		}
	}

// FUNCION ACTUALIZAR INSTITUCIONES
	public function update($id,  EditCursoInstitucionesRequest $request)
	{
		try {

		//Se obtiene el id del usuario actual
		$id = Auth::user()->id;

			//Se obtiene el Usuario segùn el id encontrado
		$user = User::find($id);

			if ($user->is('admin')) 
			{


		$cur_ins = CursoInstituciones::findOrFail($id);
		$cur_ins ->nombre = Request::input('nombre');
		$cur_ins ->creditos = Request::input('creditos');
		$cur_ins ->horas = Request::input('horas');
		$cur_ins ->horas_teoricas = Request::input('horas_teoricas');
		$cur_ins ->horas_practicas = Request::input('horas_practicas');
		$cur_ins ->carrera_id = Request::input('carrera_id');
		$cur_ins ->save();

		return redirect('show/curso_instituciones');

		} else {
					return view('no_autorizado');
			}

		}catch (Illuminate\Database\Eloquent\ModelNotFoundException $e) {
		     return Response::make('No encontrado', 404);
		}
			
	}

	public function principalcomision()
	{
		try {

		//Se obtiene el id del usuario actual
		$id = Auth::user()->id;

			//Se obtiene el Usuario segùn el id encontrado
		$user = User::find($id);

			if ($user->is('admin')) 
			{

			return view('administrador/curso_instituciones');

		} else {
					return view('no_autorizado');
			}

		}catch (Illuminate\Database\Eloquent\ModelNotFoundException $e) {
		     return Response::make('No encontrado', 404);
		}
	}
}
