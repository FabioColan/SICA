<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\CarreraInstitucionCarreraUpci;

class CarreraInstitucionCarreraUPCISeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
        CarreraInstitucionCarreraUpci::create(array(
            'carrera_institucion_id' => 3, //cesca
            'carrera_upci_id' => 1 //ingenieria de sistemas
        ));
        CarreraInstitucionCarreraUpci::create(array(
            'carrera_institucion_id' => 7, //computronic
            'carrera_upci_id' => 1 //ingenieria de sistemas
        ));
        CarreraInstitucionCarreraUpci::create(array(
            'carrera_institucion_id' => 9, //computronic
            'carrera_upci_id' => 1 //ingenieria de sistemas
        ));
	}

}
