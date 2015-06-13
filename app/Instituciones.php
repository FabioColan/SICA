<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Instituciones extends Model {

	//
	protected $table = 'instituciones';

	public function carrera_institucion() {

		return $this->hasMany('App\CarreraInstituciones','institucion_id', 'id');
		//return $this->belongsTo('App\CarreraInstituciones', 'institucion_id','id');
	}

	
}
