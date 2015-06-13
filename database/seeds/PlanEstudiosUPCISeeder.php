<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\PlanEstudiosUPCI;

class PlanEstudiosUPCISeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{

        PlanEstudiosUPCI::create(array(
            'nombre' => '2015',
            'codigo_resolucion' => '13A1'
            ));
    }

}
