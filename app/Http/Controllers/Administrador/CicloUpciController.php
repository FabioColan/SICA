<?php namespace App\Http\Controllers\Administrador;

use App\Http\Controllers\Controller;
use Bican\Roles\Models\Role;
use App\User;
use Auth;
use App\CicloUPCI;
use App\Http\Requests\NuevosCiclosRequest;
use Input;
use Request;
use App\Http\Requests\EditCiclosRequest;

class CicloUpciController extends Controller {

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
 					'cicl'=> \DB::table('ciclo_upci')->get(),
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
 					'active_class_cur_upci'=>'',
 					'active_class_cicl_upci'=>'active'
 					];
 					
 			return view('administrador/ciclo_upci', $data);

		} else {
					return view('no_autorizado');
			}

		}catch (Illuminate\Database\Eloquent\ModelNotFoundException $e) {
		     return Response::make('No encontrado', 404);
		}

	}

	public function nuevo(NuevosCiclosRequest $request)
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
		$ciclos_upci_nuevo = array(	
								'nombre'  =>Input::get('ciclos_upci_nombre'),
								);

		$ciclo_upci = New CicloUPCI($ciclos_upci_nuevo);
		$ciclo_upci->push();
		// $instituciones->save();

		return redirect('show/ciclo_upci');

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
 				'active_class_moda' => '',
 				'active_class_facu_upci'=>'',
 				'active_class_carr_upci'=>'',
 				'active_class_plan_upci'=>'active',
 				'active_class_cur_upci'=>'',
 				'active_class_cicl_upci'=>'',
 				'ci'=>CicloUPCI::findOrFail($id)
 				];

		return view('administrador/ciclo_upci_edit', $data);
		//	return redirect ('show/instituciones');

		} else {
					return view('no_autorizado');
			}

		}catch (Illuminate\Database\Eloquent\ModelNotFoundException $e) {
		     return Response::make('No encontrado', 404);
		}
	}

// FUNCION ACTUALIZAR INSTITUCIONES
	public function update($id,  EditCiclosRequest $request)
	{
		try {

		//Se obtiene el id del usuario actual
		$id = Auth::user()->id;

			//Se obtiene el Usuario segùn el id encontrado
		$user = User::find($id);

			if ($user->is('admin')) 
			{



		$ci = CicloUPCI::findOrFail($id);
		$ci ->nombre = Request::input('nombre');
		$ci ->save();

		return redirect('show/ciclo_upci');

		} else {
					return view('no_autorizado');
			}

		}catch (Illuminate\Database\Eloquent\ModelNotFoundException $e) {
		     return Response::make('No encontrado', 404);
		}
			
	}


	public function principaladministrador()
	{
		try {

		//Se obtiene el id del usuario actual
		$id = Auth::user()->id;

			//Se obtiene el Usuario segùn el id encontrado
		$user = User::find($id);

			if ($user->is('admin')) 
			{

				return view('administrador/ciclo_upci');

		} else {
					return view('no_autorizado');
			}

		}catch (Illuminate\Database\Eloquent\ModelNotFoundException $e) {
		     return Response::make('No encontrado', 404);
		}
	}
}
