<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class SolicitudPostulante extends Model {

	//
	protected $table = 'solicitud_postulantes';

	protected $fillable = [	'postulante_id',
							'instituciones_id',
							'carrera_instit_id',
							'ciclo_estudio',
							'carrera_upci_id',
							'modalidad_id',
							'estado_id'	
							];
}
