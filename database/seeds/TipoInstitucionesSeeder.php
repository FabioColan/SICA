<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\CursosInstitucionTipo;

use App\TipoInstituciones;

class TipoInstitucionesSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{

        TipoInstituciones::create(array(
            'nombre' => 'Instituto Superior'
        ));
        TipoInstituciones::create(array(
            'nombre' => 'Universidad'
        ));
       
        
	}

}
