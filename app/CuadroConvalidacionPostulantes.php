<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class CuadroConvalidacionPostulantes extends Model {

	//
	protected $table = 'cuadro_convalidacion_postulantes';

	protected $fillable = [
			'nota_curso_upci',
			'nota_curso_upci',
		    'nota_curso_institucion', 
	      	'solicitud_postulantes', 
	      	'curso_solipos_id', 
	      	'curso_carrera_upci_id', 
	      	'expediente_id', 
		];
		
}
