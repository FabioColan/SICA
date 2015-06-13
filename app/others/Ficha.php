<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Ficha extends Model {

	//
	protected $table = 'fichas';

	protected $fillable = [	'alumno_id',
							'instituciones_id',
							'carrera_institucion_id',
							'ciclo_estudio',
							'carrera_id',
							'modalidad_id',
							'adjuntos_id',
							'id_estado'	

							];
}
