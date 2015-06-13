<?php namespace App\Http\Controllers\Administrador;

use App\Http\Controllers\Controller;
use Bican\Roles\Models\Role;
use App\User;
use Auth;
use App\CursoCarreraUPCI;
use App\Http\Requests\NuevoCursosCarrerasUPCIRequest;
use Input;
use Request;
use App\Http\Requests\EditCursosCarrerasUPCIRequest;
use App\CicloUPCI;
use App\CarreraUPCI;
use App\PlanEstudiosUPCI;

class CursosCarrerasUpciController extends Controller {

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
 					'cur_upci'=> \DB::table('curso_carrera_upci')->get(),
 					'active_principal' => '',
 					'active_usuario' => '',
 					'active_mantenimiento'=>'active',
 					'active_class_inst' => '',
 					'active_class_carr_inst'=>'',
 					'active_class_cur_inst' => '',
 					'active_class_moda' => '',
 					'active_class_facu_upci'=>'',
 					'active_class_carr_upci'=>'',
 					'active_class_plan_upci'=>'',
 					'active_class_cur_upci'=>'active',
 					'active_class_cicl_upci'=>'',
 					'Ciclo' => array('-- Seleccione Ciclo --') + \DB::table('ciclo_upci')->lists('nombre','id'),
 					'Carreras' => array('-- Seleccione Carrera --') + \DB::table('carrera_upci')->lists('nombre','id'),
 					'PlanEstudioUPCI' => array('-- Seleccione Plan de Estudio --') + \DB::table('plan_estudios_upci')->lists('nombre','id')
 					];
 						
 			return view('administrador/curso_carreras_upci', $data);

		} else {
					return view('no_autorizado');
			}

		}catch (Illuminate\Database\Eloquent\ModelNotFoundException $e) {
		     return Response::make('No encontrado', 404);
		}
	}

	public function nuevo(NuevoCursosCarrerasUPCIRequest $request)
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
		$curso_carreras_upci_nuevo = array(	
								'nombre'  			=>Input::get('curso_upci_nombre'),
								'codigo'  			=>Input::get('curso_upci_codigo'),
								'creditos' 			=>Input::get('creditos_curso_upci'),
								'hora_teorica'  	=>Input::get('horas_teoricas_curso_upci'),
								'hora_practica'  	=>Input::get('horas_practicas_curso_upci'),
								'th'  				=>Input::get('horas_curso_upci'),
								'ciclo_upci_id'		=>Input::get('ciclos_upci'),
								'carrera_upci_id' 	=>Input::get('carreras_upci'),
								'plan_upci_id' 		=>Input::get('plan_upci')
								);
		// dd($curso_carreras_upci_nuevo);
		$curso_carreras_upci = New CursoCarreraUPCI($curso_carreras_upci_nuevo);
		$curso_carreras_upci->push();
		// $curso_carreras_nuevo->save();

		return redirect('show/curso_carreras_upci');

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


		$data = [
				'Ciclo' => CarreraUPCI::lists('nombre','id'),
				'Carreras' => CarreraUPCI::lists('nombre','id'),
				'PlanEstudioUPCI' => PlanEstudiosUPCI::lists('nombre','id'),
				'active_principal' => '',
 				'active_usuario' => '',
 				'active_mantenimiento'=>'active',
 				'active_class_inst' => '',
 				'active_class_carr_inst'=>'',
 				'active_class_cur_inst' => '',
 				'active_class_moda' => '',
 				'active_class_facu_upci'=>'',
 				'active_class_carr_upci'=>'',
 				'active_class_plan_upci'=>'',
 				'active_class_cur_upci'=>'active',
 				'active_class_cicl_upci'=>'',
 				'cur_up'=>CursoCarreraUPCI::findOrFail($id)
 				];

		return view('administrador/curso_carreras_upci_edit', $data);
		//	return redirect ('show/instituciones');

		} else {
					return view('no_autorizado');
			}

		}catch (Illuminate\Database\Eloquent\ModelNotFoundException $e) {
		     return Response::make('No encontrado', 404);
		}
	}

// FUNCION ACTUALIZAR INSTITUCIONES
	public function update($id,  EditCursosCarrerasUPCIRequest $request)
	{
		try {

		//Se obtiene el id del usuario actual
		$id = Auth::user()->id;

			//Se obtiene el Usuario segùn el id encontrado
		$user = User::find($id);

			if ($user->is('admin')) 
			{

		$cur_up = CursoCarreraUPCI::findOrFail($id);
		$cur_up ->nombre = Request::input('nombre');
		$cur_up ->codigo = Request::input('codigo');
		$cur_up ->creditos = Request::input('creditos');
		$cur_up ->hora_teorica = Request::input('hora_teorica');
		$cur_up ->hora_practica = Request::input('hora_practica');
		$cur_up ->th = Request::input('th');
		$cur_up ->ciclo_upci_id = Request::input('ciclo_upci_id');
		$cur_up ->carrera_upci_id = Request::input('carrera_upci_id');
		$cur_up ->plan_upci_id = Request::input('plan_upci_id');
		$cur_up ->save();

		return redirect('show/curso_carreras_upci');

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

				return view('administrador/curso_carreras_upci');

		} else {
					return view('no_autorizado');
			}

		}catch (Illuminate\Database\Eloquent\ModelNotFoundException $e) {
		     return Response::make('No encontrado', 404);
		}
	}
}