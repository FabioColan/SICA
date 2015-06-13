<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\CarreraUPCI;

class CarrerasUPCISeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{

        CarreraUPCI::create(array(
            'nombre' => 'Ingeniería de Sistemas e Informática',
            'facultad_id' => 1
        ));
        CarreraUPCI::create(array(
            'nombre' => 'Ingeniería en Telecomunicaciones',
            'facultad_id' => 1
        ));
       CarreraUPCI::create(array(
            'nombre' => 'Ingeniería Industrial',
            'facultad_id' => 1
        ));
       CarreraUPCI::create(array(
            'nombre' => 'Contabilidad y Auditoría y Finanzas',
            'facultad_id' => 2
        ));
        CarreraUPCI::create(array(
            'nombre' => 'Administración y Negocios Internacionales',
            'facultad_id' => 2
        ));
       CarreraUPCI::create(array(
            'nombre' => 'Administración en Turismo, Hotelería y Gastronomía',
            'facultad_id' => 2
        ));
       CarreraUPCI::create(array(
            'nombre' => 'Economía (Con mención en finanzas globales)',
            'facultad_id' => 2
        ));
       CarreraUPCI::create(array(
            'nombre' => 'Derecho',
            'facultad_id' => 3
        ));
	}

}
