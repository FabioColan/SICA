<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class CursosSolicitudPostulante extends Model {

	//
	protected $table = 'cursos_solicitud_postulantes';

	protected $fillable = ['nombre',
							'creditos',
							'horas',
							'horas_teoricas',
							'horas_practicas',
							'nota',
							'solicitud_id',
							'curso_institucion_id'
							];
}
