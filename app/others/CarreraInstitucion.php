<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class CarreraInstitucion extends Model {

	

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'carrera_institucion';

	public function instituciones() {

		return $this->belongsTo('App\Institucion', 'institucion_id','id');
		
	}
	

}

