<?php namespace App\Http\Controllers\Administrador;

use App\Http\Controllers\Controller;
use Bican\Roles\Models\Role;
use App\User;
use Auth;
use App\Roles;
use App\Http\Requests\RegistrarUsuario;
use Input;
use App\RoleUser;

class RegistrarUsuariosController extends Controller {

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


		//Se obtiene el id del usuario actual
		$id = Auth::user()->id;

		//Se obtiene el Usuario segùn el id encontrado
		$user = User::find($id);

		if ($user->is('admin')) 
		{
			
			$data = [
					'rol'=> array('-- Seleccione Rol --') + \DB::table('roles')->whereIn('id',[2,3])->lists('name','id'),
					'active_principal' => '',
 					'active_usuario' => 'active',
 					'active_mantenimiento'=>'',
 					'active_class_inst' => '',
 					'active_class_carr_inst'=>'',
 					'active_class_cur_inst' => '',
 					'active_class_moda' => '',
 					'active_class_facu_upci'=>'',
 					'active_class_carr_upci'=>'',
 					'active_class_plan_upci'=>'',
 					'active_class_cur_upci'=>'',
 					'active_class_cicl_upci'=>''
 					];
 					
 			return view('administrador/registrar_usuario', $data);

		} else {
			return 'No autorizado';
		}

		} else {
					return view('no_autorizado');
			}

		}catch (Illuminate\Database\Eloquent\ModelNotFoundException $e) {
		     return Response::make('No encontrado', 404);
		}

	}

	public function registrarUsuario(RegistrarUsuario $request)
	{	

		try {

		//Se obtiene el id del usuario actual
		$id = Auth::user()->id;

			//Se obtiene el Usuario segùn el id encontrado
		$user = User::find($id);

			if ($user->is('admin')) 
			{



		//REGISTRA LOS DATOS EN DOS TABLAS
		//POSTULANTE

		//Se obtiene el id del usuario actual
		// $id = Auth::user()->id;

		$usuario_data = array(
								'name'				=> Input::get 			('name'), 
								'email'				=> Input::get 			('email'),
								'password'			=> bcrypt(Input::get 	('password'))
								);
		
		$usu = New User($usuario_data);
		$usu->save();

		$id_user = \DB::table('users')->where('email', Input::get('email'))->pluck('id');

		$rol = New RoleUser();
		$rol->role_id = Input::get('tipo_usuario');
		$rol->user_id = $id_user;
		$rol->push();
		$rol->save();

				  
		$data = ['nombre' => 'Fabio Colán'];
		\Mail::send('mail', $data, function($message)
		{	
			$email = Auth::user()->email;
			$name = Auth::user()->name;
			$message->to($email, $name)->subject('Bienvenido al sistema (v. x.x), gracias por participar en las pruebas!');

		});		

		//return redirect()->route('registrar');
		return redirect('usuario');

		} else {
					return view('no_autorizado');
			}

		}catch (Illuminate\Database\Eloquent\ModelNotFoundException $e) {
		     return Response::make('No encontrado', 404);
		}

	}


	public function crear_usuarioadministrador()
	{
		try {

		//Se obtiene el id del usuario actual
		$id = Auth::user()->id;

			//Se obtiene el Usuario segùn el id encontrado
		$user = User::find($id);

			if ($user->is('admin')) 
			{

				return view('administrador/registrar_usuario');

		} else {
					return view('no_autorizado');
			}

		}catch (Illuminate\Database\Eloquent\ModelNotFoundException $e) {
		     return Response::make('No encontrado', 404);
		}		
	}
}
