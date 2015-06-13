<?php namespace App\Http\Controllers\Administrador;

use App\Http\Controllers\Controller;
use Bican\Roles\Models\Role;
use App\User;
use Auth;
use Request;
use App\RoleUser;

class UsuariosController extends Controller {

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
		//Se obtiene el id del usuario actual
		$id = Auth::user()->id;

		//Se obtiene el Usuario segùn el id encontrado
		$user = User::find($id);

		if ($user->is('admin')) 
		{
			
			$data = [
					'us'=> \DB::table('lista_usuarios')->get(),
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
 					
 			return view('administrador/usuario', $data);

		} else {
			return 'No autorizado';
		}

	}


	public function crear_usuarioadministrador(){
		return view('administrador/usuario');
	}

	public function deshabilitar($id){

		

		if (Request::ajax())
		{

			$rol_ant = \DB::table('role_user')->where('user_id',$id)->pluck('role_id');

			// $rol = RoleUser::find($id);
			// $rol->role_id = 4; //4 indica el rol inactivo
			// $rol->role_ant = $rol_ant;
			// $rol->push();
			// $rol->save();

			\DB::table('role_user')
            ->where('user_id', $id)
            ->update(['role_id' => 4,
            		'role_ant' => $rol_ant]);

		    return response()->json([ 
		    		'mensaje' => 'Se deshabilitó al usuario correctamente',
		    	]);
		}

	}

	public function habilitar($id){

		

		if (Request::ajax())
		{

			$rol_ant = \DB::table('role_user')->where('user_id',$id)->pluck('role_id');
			$rol_orig = \DB::table('role_user')->where('user_id',$id)->pluck('role_ant');
			// $rol = RoleUser::find($id);
			// $rol->role_id = 4; //4 indica el rol inactivo
			// $rol->role_ant = $rol_ant;
			// $rol->push();
			// $rol->save();

			\DB::table('role_user')
            ->where('user_id', $id)
            ->update(['role_id' => $rol_orig,
            		'role_ant' => $rol_ant]);

		    return response()->json([ 
		    		'mensaje' => 'Se deshabilitó al usuario correctamente',
		    	]);
		}

	}
}
