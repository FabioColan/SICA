<?php namespace App\Http\Controllers\Administrador;

use App\Http\Controllers\Controller;
use Bican\Roles\Models\Role;
use App\User;
use Auth;
use App\CarreraUPCI;
use App\Http\Requests\NuevaCarreraUPCIRequest;
use Input;
use Request;
use App\Http\Requests\EditCarreraUPCIRequest;
use App\FacultadUPCI;


class CarrerasUpciController extends Controller {

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
					'carr_upci'=> \DB::table('carrera_upci')->get(),
 					'active_principal' => '',
 					'active_usuario' => '',
 					'active_mantenimiento'=>'active',
 					'active_class_inst' => '',
 					'active_class_carr_inst'=>'',
 					'active_class_cur_inst' => '',
 					'active_class_moda' => '',
 					'active_class_facu_upci'=>'',
 					'active_class_carr_upci'=>'active',
 					'active_class_plan_upci'=>'',
 					'active_class_cur_upci'=>'',
 					'active_class_cicl_upci'=>'',
 					'Facultades' => array('-- Seleccione Facultad --') + \DB::table('facultad_upci')->lists('nombre','id')
 					];
 					
 			return view('administrador/carreras_upci', $data);

		} else {
					return view('no_autorizado');
			}

		}catch (Illuminate\Database\Eloquent\ModelNotFoundException $e) {
		     return Response::make('No encontrado', 404);
		}

	}

	public function nuevo(NuevaCarreraUPCIRequest $request)
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
		$carrera_facultades_nuevo = array(	
								'nombre' 		 =>Input::get('carrera_facultades_nombre'),
								'facultad_id' =>Input::get('carrera_facultades_tipo')
								);
		// dd($carrera_instituciones_nuevo);

		$carrerafacultades = New CarreraUPCI($carrera_facultades_nuevo);
		$carrerafacultades->push();
		// $carrerasfacultades->save();

		return redirect('show/carreras_upci');

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

		
		$data = ['Facultades' => FacultadUPCI::lists('nombre','id'),
				'active_principal' => '',
 				'active_usuario' => '',
 				'active_mantenimiento'=>'active',
 				'active_class_inst' => '',
 				'active_class_carr_inst'=>'',
 				'active_class_cur_inst' => '',
 				'active_class_moda' => '',
 				'active_class_facu_upci'=>'',
 				'active_class_carr_upci'=>'active',
 				'active_class_plan_upci'=>'',
 				'active_class_cur_upci'=>'',
 				'active_class_cicl_upci'=>'',
 				'ca_upci'=>CarreraUPCI::findOrFail($id)
 				];

		return view('administrador/carreras_upci_edit', $data);
		//	return redirect ('show/instituciones');

		} else {
					return view('no_autorizado');
			}

		}catch (Illuminate\Database\Eloquent\ModelNotFoundException $e) {
		     return Response::make('No encontrado', 404);
		}
	}

// FUNCION ACTUALIZAR INSTITUCIONES
	public function update($id,  EditCarreraUPCIRequest $request)
	{
		try {

		//Se obtiene el id del usuario actual
		$id = Auth::user()->id;

			//Se obtiene el Usuario segùn el id encontrado
		$user = User::find($id);

			if ($user->is('admin')) 
			{



		$ca_upci = CarreraUPCI::findOrFail($id);
		$ca_upci ->nombre = Request::input('nombre');
		$ca_upci ->facultad_id = Request::input('facultad_id');
		$ca_upci ->save();

		return redirect('show/carreras_upci');

		} else {
					return view('no_autorizado');
			}

		}catch (Illuminate\Database\Eloquent\ModelNotFoundException $e) {
		     return Response::make('No encontrado', 404);
		}
			
	}


	public function principaladminstrador()
	{
		try {

		//Se obtiene el id del usuario actual
		$id = Auth::user()->id;

			//Se obtiene el Usuario segùn el id encontrado
		$user = User::find($id);

			if ($user->is('admin')) 
			{

		return view('administrador/carreras_upci');

		} else {
					return view('no_autorizado');
			}

		}catch (Illuminate\Database\Eloquent\ModelNotFoundException $e) {
		     return Response::make('No encontrado', 404);
		}
	}
}
