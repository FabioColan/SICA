<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\FacultadUPCI;

class FacultadesUPCISeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{

        FacultadUPCI::create(array(
            'nombre' => 'FACULTAD DE CIENCIAS E INGENIERÍA',
        ));
        FacultadUPCI::create(array(
            'nombre' => 'FACULTAD DE CIENCIAS EMPRESARIALES Y DE NEGOCIOS',
        ));
       FacultadUPCI::create(array(
            'nombre' => 'FACULTAD DE DERECHO Y CIENCIAS POLÍTICAS',
        ));
	}

}
