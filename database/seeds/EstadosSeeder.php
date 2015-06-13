<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Estados;

class EstadosSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{

        Estados::create(array(
            'nombre' => 'En proceso'
        ));
        Estados::create(array(
            'nombre' => 'Incompleto'
        ));
        Estados::create(array(
            'nombre' => 'Completo'
        ));
        Estados::create(array(
            'nombre' => 'Expedito'
        ));
        Estados::create(array(
            'nombre' => 'Registró Solicitud Postulante.'
        ));
        Estados::create(array(
            'nombre' => 'Registró Solicitud Postulante y Cursos.'
        ));
        Estados::create(array(
            'nombre' => 'Registró Solicitud Postulante, Cursos y Adjuntos.'
        ));
        Estados::create(array(
            'nombre' => 'Registró Solicitud Ampliacion.'
        ));
        Estados::create(array(
            'nombre' => 'Registró Solicitud Ampliacion y cursos.'
        ));
        Estados::create(array(
            'nombre' => 'Registró Solicitud Ampliacion, cursos y adjuntos.'
        ));
        Estados::create(array(
            'nombre' => 'Comunicarse con soporte informático de la Universidad.'
        ));
	}

}
