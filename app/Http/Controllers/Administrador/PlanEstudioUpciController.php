<?php namespace App\Http\Controllers\Administrador;

use App\Http\Controllers\Controller;
use Bican\Roles\Models\Role;
use App\User;
use Auth;
use App\PlanEstudiosUPCI;
use App\Http\Requests\NuevosPlanEstudiosUPCIRequest;
use Input;
use Request;
use App\Http\Requests\EditPlanEstudiosUPCIRequest;

class PlanEstudioUpciController extends Controller {

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
					'plan'=> \DB::table('plan_estudios_upci')->get(),
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
 					'active_class_cicl_upci'=>''
 					];
 					
 			return view('administrador/plan_estudios_upci', $data);

		} else {
					return view('no_autorizado');
			}

		}catch (Illuminate\Database\Eloquent\ModelNotFoundException $e) {
		     return Response::make('No encontrado', 404);
		}

	}

	public function nuevo(NuevosPlanEstudiosUPCIRequest $request)
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
		$plan_estudios_ucpi_nuevo = array(	
								'nombre'  				=>Input::get('plan_estudios_upci_nombre'),
								'codigo_resolucion'  	=>Input::get('plan_estudios_upci_codigo')
								);

		$plan_estudios_upci = New PlanEstudiosUPCI($plan_estudios_ucpi_nuevo);
		$plan_estudios_upci->push();
		// $plan_estudios_upci->save();

		return redirect('show/plan_estudios_upci');

		} else {
					return view('no_autorizado');
			}

		}catch (Illuminate\Database\Eloquent\ModelNotFoundException $e) {
		     return Response::make('No encontrado', 404);
		}
	}

// FUNCION EDITAR PLAN DE ESTUDIO
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
 				'plan_estu'=>PlanEstudiosUPCI::findOrFail($id)
 				];

		return view('administrador/plan_estudios_upci_edit', $data);
		//	return redirect ('show/instituciones');

		} else {
					return view('no_autorizado');
			}

		}catch (Illuminate\Database\Eloquent\ModelNotFoundException $e) {
		     return Response::make('No encontrado', 404);
		}
	}

// FUNCION ACTUALIZAR PLAN DE ESTUDIO
	public function update($id,  EditPlanEstudiosUPCIRequest $request)
	{
		try {

		//Se obtiene el id del usuario actual
		$id = Auth::user()->id;

			//Se obtiene el Usuario segùn el id encontrado
		$user = User::find($id);

			if ($user->is('admin')) 
			{


		$plan_estu = PlanEstudiosUPCI::findOrFail($id);
		$plan_estu ->nombre = Request::input('nombre');
		$plan_estu ->codigo_resolucion = Request::input('codigo_resolucion');
		$plan_estu ->save();

		return redirect('show/plan_estudios_upci');

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

				return view('administrador/plan_estudios_upci');

		} else {
					return view('no_autorizado');
			}

		}catch (Illuminate\Database\Eloquent\ModelNotFoundException $e) {
		     return Response::make('No encontrado', 404);
		}
	}
}
