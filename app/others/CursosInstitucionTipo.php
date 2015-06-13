<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class CursosInstitucionTipo extends Model {

	//

	protected $table = 'cursos_institucion_tipos';

	public function curso_institucion_tipo() {

		return $this->hasMany('App\CursosInstituciones','cursos_institucion_tipos_id','id');
		
	}

}
