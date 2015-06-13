<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class CursoInstituciones extends Model {

	//
	protected $table = 'curso_instituciones';

	protected $fillable = ['nombre',
						'creditos',
						'horas',
						'horas_teoricas',
						'horas_practicas',
						'carrera_id',
						];
}
