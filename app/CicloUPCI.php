<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class CicloUPCI extends Model {

	//
	protected $table = 'ciclo_upci';

	public function cursos_upci() {

		return $this->hasMany('App\CursoCarreraUPCI','ciclo_upci_id', 'id');
		//return $this->belongsTo('App\CarreraInstituciones', 'institucion_id','id');
	}

}
