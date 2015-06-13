<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\CarreraInstituciones;
use App\Comision;

class ComisionSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{

         Comision::create(array(
            'nombres' => 'Rubén Bustillos',
            'apellido_paterno' => 'Bustillos',
            'apellido_materno' => '',
            'dni' => '4152144',
            'telefono' => '44444444',
            'fecha_nacimiento' => '',
            'grado_academico' => 'Mg. en Estadística',
            'carrera_upci_id' => 1,
            'usuario_id' => 1
        ));
        
	}

}
