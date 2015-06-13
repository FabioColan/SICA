<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Postulantes extends Model {

	//
	protected $table = 'postulantes';
	
	protected $fillable = [		'codigo',
								'apellido_paterno',
								'apellido_materno',
								'nombres',
								'fecha_nacimiento',
								'lugar_nacimiento',
								'documento_identidad',
								'sexo',
								'direccion',
								'telefono_fijo',
								'telefono_celular',
								'colegio',
								'tipo_colegio',
								'ubicacion_colegio',
								'datos_padres',
								'telefono_padres',
								'usuario_id' ];
}
