<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
use Bican\Roles\Models\Role;
use App\User;

use App\CarreraInstituciones;
use App\Instituciones;
use App\CursoInstituciones;
use App\CicloUPCI;

//LOGIN
Route::get('/', 'LoginController@index');
Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);


//ALUMNO
Route::get('solicitar', 					'Alumno\SolicitarController@index');
//Route::post('solicitar/grabarFicha',		'Alumno\SolicitarController@grabarFicha');
Route::post('solicitar/registrarCursos',	'Alumno\SolicitarController@registrarCursos');

Route::post('registrar',					'Alumno\RegistrarController@index');
Route::post('registrar/grabar',				'Alumno\RegistrarController@grabar');
Route::post('registrar/grabar-new',			'Alumno\RegistrarController@nuevo');
//Route::get('registrar/delete/{id}',			'Alumno\RegistrarController@delete', ['']);

Route::delete('registrar/delete/{id}', [
    'as' => 'curso.delete', 'uses' => 'Alumno\RegistrarController@delete'
]);

Route::get('enviar/cursos', 				'Alumno\RegistrarController@enviarCursos');
Route::get('show/cursos',					'Alumno\RegistrarController@show');

Route::get('notificacion',					'Alumno\NotificacionController@show');

Route::get('estado',						'Alumno\EstadoController@show');

Route::get('ampliacion',					'Alumno\AmpliacionController@show');
Route::get('ampliacion/none',				'Alumno\AmpliacionController@none');

Route::get('adjuntar', 						'Alumno\AdjuntarController@index');
Route::post('adjuntar/grabar', 				'Alumno\AdjuntarController@grabar');
Route::get('show/adjuntos', 				'Alumno\AdjuntarController@show');
Route::get('show/completar', 				'Alumno\AdjuntarController@showCompletar');
Route::post('adjuntar/completar', 			'Alumno\AdjuntarController@grabarAdicional');
Route::post('adjuntar/enviar', 				'Alumno\AdjuntarController@enviarAdicional');

Route::delete('adjuntar/delete/{id}', [
    'as' => 'adjunto.delete', 'uses' 	=> 'Alumno\AdjuntarController@delete'
]);


Route::get('mail', function(){
	$data = [ 'nombre' => 'Abraham Aquino'
	];
	Mail::send('mail', $data, function($message)
	{
    $message->to('abrahamyup@gmail.com', 'Abraham Aquino')->subject('Bienvenido!');
	});

});

// Route::get('mail', function(){
// 	 $data = ['nombre' => 'Abraham Aquino'];
// 		  \Mail::send('mail', $data, function($message)
// 			{	
// 				$email = \Auth::user()->email;
// 		  		$name = \Auth::user()->name;
// 		  		dd($name);
// 		    	$message->to($email, "h".$name)->subject('Bienvenido al sistema (v. 1.3), gracias por participar en las pruebas!');

// 			});		

// });

Route::post('/upload', function(){
     if(Input::hasFile('titulo_id')) {
          Input::file('titulo_id')
               ->move('adjuntos','NuevoNombre');
     }
     return Redirect::back('/');
});


Route::get('dropdown', function(){

	$id = Input::get('option');
	$carrera_institucion = Instituciones::find($id)->carrera_institucion;
	
	return $carrera_institucion->lists('nombre', 'id');

});

//obtiene mediante ajax el campo de hora del curso seleccionado
Route::get('hora', function(){

	$id = Input::get('curso_cbo');
	$hora = DB::table('curso_instituciones')->where('id', $id)->first();
	dd($hora->id);
	return $hora[0];

});

Route::get('mostrar', function(){

	$id = Input::get('option');
	$carrera_institucion = Instituciones::find($id)->carrera_institucion;
	
	return $carrera_institucion->lists('nombre', 'id');


});

Route::get('cursos_upci', function(){

	$id = Input::get('option');
	$cursos_upci = CicloUPCI::find($id)->cursos_upci;
	
	return $cursos_upci->lists('nombre', 'id');

});


Route::post('solicitud/{codigo}', [
    'as' => 'comision.solicitud', 'uses' => 'Comision\PrincipalController@ver_solicitud'
]);


//COMISION

Route::get('comision/principal',				'Comision\PrincipalController@index');
Route::get('comision/validar/{cod_postu}',		'Comision\ValidarController@index');
Route::post('comision/vali',					'Comision\ValidarController@validar');

Route::get('validar/show', 						'Comision\ValidarController@show');
Route::get('comision/estado',					'Comision\PrincipalController@index');

Route::get('comision/convalidar/{cod_postu}',	'Comision\ConvalidarController@index');
Route::post('comision/convalidar/grabar',		'Comision\ConvalidarController@grabar');
Route::get('comision/convalidar/show/{cod_postu}',			'Comision\ConvalidarController@show');


Route::post('adjunto/{codigo}', [
    'as' => 'comision.adjunto', 'uses' => 'Comision\ConvalidarController@adjunto'
]);

//COMISION
Route::post('/comision/grabarFicha',	'Comision\ConvalidarController@grabarFicha');
Route::post('/comision/actualizarFicha','Comision\ConvalidarController@actualizarFicha');
Route::post('/comision/mostrarFicha',	'Comision\ConvalidarController@mostrarFicha');


//ADMINISTRADOR
//Route::get('principal-administrador', 'AdministradorController@principal');
Route::get('administrador', 'Administrador\PrincipalController@index');
Route::get('usuario', 'Administrador\UsuariosController@index');
Route::get('instituciones', 'Administrador\InstitucionesController@index');
Route::get('carreras_instituciones', 'Administrador\CarrerasInstitucionesController@index');
Route::get('curso_instituciones', 'Administrador\CursosInstitucionesController@index');
Route::get('modalidad_estudio', 'Administrador\ModalidadEstudioController@index');
Route::get('facultad_upci', 'Administrador\FacultadesUpciController@index');
Route::get('carreras_upci', 'Administrador\CarrerasUpciController@index');
Route::get('curso_carreras_upci', 'Administrador\CursosCarrerasUpciController@index');
Route::get('ciclo_upci', 'Administrador\CicloUpciController@index');
Route::get('plan_estudios_upci', 'Administrador\PlanEstudioUpciController@index');
Route::get('registrar_usuario', 'Administrador\RegistrarUsuariosController@index');

Route::post('registrar_usuario/grabar-new', 'Administrador\RegistrarUsuariosController@registrarUsuario');
Route::get('show/registrar_usuario', 'Administrador\RegistrarUsuariosController@index');

Route::post('instituciones/grabar-new', 'Administrador\InstitucionesController@nuevo');
Route::put('instituciones/update-new/{id}', 'Administrador\InstitucionesController@update');
Route::get('show/instituciones', 'Administrador\InstitucionesController@index');

Route::post('carreras_instituciones/grabar-new', 'Administrador\CarrerasInstitucionesController@nuevo');
Route::put('carreras_instituciones/update-new/{id}', 'Administrador\CarrerasInstitucionesController@update');
Route::get('show/carreras_instituciones', 'Administrador\CarrerasInstitucionesController@index');

Route::post('curso_instituciones/grabar-new', 'Administrador\CursosInstitucionesController@nuevo');
Route::put('curso_instituciones/update-new/{id}', 'Administrador\CursosInstitucionesController@update');
Route::get('show/curso_instituciones', 'Administrador\CursosInstitucionesController@index');

Route::post('modalidad_estudio/grabar-new', 'Administrador\ModalidadEstudioController@nuevo');
Route::put('modalidad_estudio/update-new/{id}', 'Administrador\ModalidadEstudioController@update');
Route::get('show/modalidad_estudio', 'Administrador\ModalidadEstudioController@index');

Route::post('facultad_upci/grabar-new', 'Administrador\FacultadesUpciController@nuevo');
Route::put('facultad_upci/update-new/{id}', 'Administrador\FacultadesUpciController@update');
Route::get('show/facultad_upci', 'Administrador\FacultadesUpciController@index');
Route::post('carreras_upci/grabar-new', 'Administrador\CarrerasUpciController@nuevo');
Route::put('carreras_upci/update-new/{id}', 'Administrador\CarrerasUpciController@update');
Route::get('show/carreras_upci', 'Administrador\CarrerasUpciController@index');

Route::post('plan_estudios_upci/grabar-new', 'Administrador\PlanEstudioUpciController@nuevo');
Route::put('plan_estudios_upci/update-new/{id}', 'Administrador\PlanEstudioUpciController@update');
Route::get('show/plan_estudios_upci', 'Administrador\PlanEstudioUpciController@index');

Route::post('ciclo_upci/grabar-new', 'Administrador\CicloUpciController@nuevo');
Route::put('ciclo_upci/update-new/{id}', 'Administrador\CicloUpciController@update');
Route::get('show/ciclo_upci', 'Administrador\CicloUpciController@index');

Route::post('curso_carreras_upci/grabar-new', 'Administrador\CursosCarrerasUpciController@nuevo');
Route::put('curso_carreras_upci/update-new/{id}', 'Administrador\CursosCarrerasUpciController@update');
Route::get('show/curso_carreras_upci', 'Administrador\CursosCarrerasUpciController@index');
Route::get('instituciones_edit/{id}', ['as' => 'instituciones.edit', 'uses' => 'Administrador\InstitucionesController@edit']);
Route::get('carreras_instituciones_edit/{id}', ['as' => 'carreras_instituciones.edit', 'uses' => 'Administrador\CarrerasInstitucionesController@edit']);
Route::get('curso_instituciones/{id}', ['as' => 'curso_instituciones.edit', 'uses' => 'Administrador\CursosInstitucionesController@edit']);
Route::get('modalidad_estudio/{id}', ['as' => 'modalidad_estudio.edit', 'uses' => 'Administrador\ModalidadEstudioController@edit']);
Route::get('facultad_upci_edit/{id}', ['as' => 'facultad.edit', 'uses' => 'Administrador\FacultadesUpciController@edit']);
Route::get('carreras_upci_edit/{id}', ['as' => 'carreras_upci.edit', 'uses' => 'Administrador\CarrerasUpciController@edit']);
Route::get('plan_estudios_upci_edit/{id}', ['as' => 'plan_estudios_upci.edit', 'uses' => 'Administrador\PlanEstudioUpciController@edit']);
Route::get('ciclo_upci_edit/{id}', ['as' => 'ciclo_upci.edit', 'uses' => 'Administrador\CicloUpciController@edit']);
Route::get('curso_carreras_upci_edit/{id}', ['as' => 'curso_carreras_upci.edit', 'uses' => 'Administrador\CursosCarrerasUpciController@edit']);

//ruta para deshabilitar/habilitar al usuario
Route::post('deshabilita/usuario/{id}', [
    'as' => 'user.deshabilitar', 'uses' 	=> 'Administrador\UsuariosController@deshabilitar'
]);
Route::post('habilita/usuario/{id}', [
    'as' => 'user.habilitar', 'uses' 	=> 'Administrador\UsuariosController@habilitar'
]);