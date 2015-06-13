<?php namespace App\Http\Controllers\Administrador;

use App\Http\Controllers\Controller;
use Bican\Roles\Models\Role;
use App\User;
use Auth;
use App\Modalidades;
use App\Http\Requests\NuevasModalidadesRequest;
use Input;
use Request;
use App\Http\Requests\EditModalidadesRequest;

class ModalidadEstudioController extends Controller {

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
					'moda'=> \DB::table('modalidades')->get(),
 					'active_principal' => '',
 					'active_usuario' => '',
 					'active_mantenimiento'=>'active',
 					'active_class_inst' => '',
 					'active_class_carr_inst'=>'',
 					'active_class_cur_inst' => '',
 					'active_class_moda' => 'active',
 					'active_class_facu_upci'=>'',
 					'active_class_carr_upci'=>'',
 					'active_class_plan_upci'=>'',
 					'active_class_cur_upci'=>'',
 					'active_class_cicl_upci'=>'',
 					];
 					
 	return view('administrador/modalidad_estudio', $data);

		} else {
					return view('no_autorizado');
			}

		}catch (Illuminate\Database\Eloquent\ModelNotFoundException $e) {
		     return Response::make('No encontrado', 404);
		}

	}

	public function nuevo(NuevasModalidadesRequest $request)
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
		$modalidades_nuevo = array(	
								'nombre'  =>Input::get('modalidades_nombre'),
								);

		$modalidades = New Modalidades($modalidades_nuevo);
		$modalidades->push();
		// $instituciones->save();

		return redirect('show/modalidad_estudio');
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
				'active_principal' => '',
 				'active_usuario' => '',
 				'active_mantenimiento'=>'active',
 				'active_class_inst' => '',
 				'active_class_carr_inst'=>'',
 				'active_class_cur_inst' => '',
 				'active_class_moda' => 'active',
 				'active_class_facu_upci'=>'',
 				'active_class_carr_upci'=>'',
 				'active_class_plan_upci'=>'',
 				'active_class_cur_upci'=>'',
 				'active_class_cicl_upci'=>'',
 				'moda_estu'=>Modalidades::findOrFail($id)
 				];

		return view('administrador/modalidad_estudio_edit', $data);
		//	return redirect ('show/instituciones');

		} else {
					return view('no_autorizado');
			}

		}catch (Illuminate\Database\Eloquent\ModelNotFoundException $e) {
		     return Response::make('No encontrado', 404);
		}
	}

// FUNCION ACTUALIZAR INSTITUCIONES
	public function update($id,  EditModalidadesRequest $request)
	{
		try {

		//Se obtiene el id del usuario actual
		$id = Auth::user()->id;

			//Se obtiene el Usuario segùn el id encontrado
		$user = User::find($id);

			if ($user->is('admin')) 
			{


		$moda_estu = Modalidades::findOrFail($id);
		$moda_estu ->nombre = Request::input('nombre');
		$moda_estu ->save();

		return redirect('show/modalidad_estudio');

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


				return view('administrador/modalidad_estudio');

		} else {
					return view('no_autorizado');
			}

		}catch (Illuminate\Database\Eloquent\ModelNotFoundException $e) {
		     return Response::make('No encontrado', 404);
		}
	}
}
