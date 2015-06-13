<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Institucion extends Model {

	

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'instituciones';


	public function carrera_institucion() {
		return $this->hasMany('App\CarreraInstitucion');
	}
	

}

