<?php namespace App\Http\Controllers\Administrador;

use App\Http\Controllers\Controller;
use Bican\Roles\Models\Role;
use App\User;
use Auth;
use App\FacultadUPCI;
use App\Http\Requests\NuevasFacultadesRequest;
use Input;
use App\Http\Requests\EditFacultadUPCIRequest;
use Request;

class FacultadesUpciController extends Controller {

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
					'facu'=> \DB::table('facultad_upci')->get(),
 					'active_principal' => '',
 					'active_usuario' => '',
 					'active_mantenimiento'=>'active',
 					'active_class_inst' => '',
 					'active_class_carr_inst'=>'',
 					'active_class_cur_inst' => '',
 					'active_class_moda' => '',
 					'active_class_facu_upci'=>'active',
 					'active_class_carr_upci'=>'',
 					'active_class_plan_upci'=>'',
 					'active_class_cur_upci'=>'',
 					'active_class_cicl_upci'=>''
 					];
 					
 	return view('administrador/facultad_upci', $data);

		} else {
					return view('no_autorizado');
			}

		}catch (Illuminate\Database\Eloquent\ModelNotFoundException $e) {
		     return Response::make('No encontrado', 404);
		}
	}

	public function nuevo(NuevasFacultadesRequest $request)
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
		$facultades_upci_nuevo = array(	
								'nombre'  =>Input::get('facultades_upci_nombre'),
								);

		$facultad_upci = New FacultadUPCI($facultades_upci_nuevo);
		$facultad_upci->push();
		// $instituciones->save();

		return redirect('show/facultad_upci');

		} else {
					return view('no_autorizado');
			}

		}catch (Illuminate\Database\Eloquent\ModelNotFoundException $e) {
		     return Response::make('No encontrado', 404);
		}
	}

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
 				'active_class_facu_upci'=>'active',
 				'active_class_carr_upci'=>'',
 				'active_class_plan_upci'=>'',
 				'active_class_cur_upci'=>'',
 				'active_class_cicl_upci'=>'',
 				'fac' => FacultadUPCI::findOrFail($id)
 				];

		return view('administrador/facultad_upci_edit', $data);
		//	return redirect ('show/facultad_upci');

		} else {
					return view('no_autorizado');
			}

		}catch (Illuminate\Database\Eloquent\ModelNotFoundException $e) {
		     return Response::make('No encontrado', 404);
		}
	}

	public function update($id,  EditFacultadUPCIRequest $request)
	{
		try {

		//Se obtiene el id del usuario actual
		$id = Auth::user()->id;

			//Se obtiene el Usuario segùn el id encontrado
		$user = User::find($id);

			if ($user->is('admin')) 
			{


		$fac = FacultadUPCI::findOrFail($id);
		$fac ->nombre = Request::input('nombre');
		$fac ->save();



		return redirect('show/facultad_upci');

		} else {
					return view('no_autorizado');
			}

		}catch (Illuminate\Database\Eloquent\ModelNotFoundException $e) {
		     return Response::make('No encontrado', 404);
		}
			
	}

	public function facultad_upciadministrador()
	{
		try {

		//Se obtiene el id del usuario actual
		$id = Auth::user()->id;

			//Se obtiene el Usuario segùn el id encontrado
		$user = User::find($id);

			if ($user->is('admin')) 
			{

				return view('administrador/facultad_upci');

		} else {
					return view('no_autorizado');
			}

		}catch (Illuminate\Database\Eloquent\ModelNotFoundException $e) {
		     return Response::make('No encontrado', 404);
		}
	}
}