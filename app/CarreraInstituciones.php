<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class CarreraInstituciones extends Model {

	//
	protected $table = 'carrera_instituciones';

	public function instituciones() {

		return $this->belongsTo('App\Instituciones', 'institucion_id','id');
		
	}
	

}
