<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Instituciones;

class InstitucionesSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{

         Instituciones::create(array(
            'nombre' => 'CESCA',
            'tipo_id' => 1
        ));
        Instituciones::create(array(
            'nombre' => 'COMPUTRONIC',
            'tipo_id' => 1
        ));
        Instituciones::create(array(
            'nombre' => 'CICEX',
            'tipo_id' => 1
        ));
        Instituciones::create(array(
            'nombre' => 'Instituto Superior Tecnológico Público María Rosario Araoz Pinto',
            'tipo_id' => 1
        ));
        Instituciones::create(array(
            'nombre' => 'Instituto Superior Tecnológico Privado Perú Pacífico',
            'tipo_id' => 1
        ));
        Instituciones::create(array(
            'nombre' => 'Instituto Superior Tecnológico San Marcos',
            'tipo_id' => 1
        ));
        Instituciones::create(array(
            'nombre' => 'Instituto Superior Tecnológico María Elena Moyano',
            'tipo_id' => 1
        ));
        Instituciones::create(array(
            'nombre' => 'Instituto Superior Tecnológico Privado Peruano Alemán - IPAL',
            'tipo_id' => 1
        ));
        Instituciones::create(array(
            'nombre' => 'Instituto Superior Tecnológico Privado Frederick Winslow Taylor',
            'tipo_id' => 1
        ));
        Instituciones::create(array(
            'nombre' => 'Instituto Superior Tecnológico Wernher Von Braun',
            'tipo_id' => 1
        ));
        Instituciones::create(array(
            'nombre' => 'Instituto Superior Tecnológico Público Argentina',
            'tipo_id' => 1
        ));        Instituciones::create(array(
            'nombre' => 'Instituto Internacional de Sistemas Empresariales - IISEP',
            'tipo_id' => 1
        ));
        Instituciones::create(array(
            'nombre' => 'Instituto Superior Tecnológico Público Simón Bolívar',
            'tipo_id' => 1
        ));
        Instituciones::create(array(
            'nombre' => 'Instituto Superior Tecnológico Público Julio César Tello',
            'tipo_id' => 1
        ));
        Instituciones::create(array(
            'nombre' => 'Instituto Superior Tecnológico Público Huaycán',
            'tipo_id' => 1
        ));
        Instituciones::create(array(
            'nombre' => 'I.S.T.P. Manuel Arevalo Cáceres',
            'tipo_id' => 1
        ));
        Instituciones::create(array(
            'nombre' => 'Instituto Superior Tecnológico Privado Metropolitano',
            'tipo_id' => 1
        ));        Instituciones::create(array(
            'nombre' => 'Instituto Superior Tecnológico Público Arturo Sabroso Montoya',
            'tipo_id' => 1
        ));
        Instituciones::create(array(
            'nombre' => 'Instituto Superior Tecnológico Público Manuel Seoane Corrales',
            'tipo_id' => 1
        ));
        Instituciones::create(array(
            'nombre' => 'Instituto Italiano de Cultura',
            'tipo_id' => 1
        ));
        Instituciones::create(array(
            'nombre' => 'Instituto Tecnológico Superior Junior Technology',
            'tipo_id' => 1
        ));
        Instituciones::create(array(
            'nombre' => 'Institución Educativa Emblemática Mariano Melgar',
            'tipo_id' => 1
        ));
        Instituciones::create(array(
            'nombre' => 'Universidad Alas Peruanas',
            'tipo_id' => 2
        ));
        Instituciones::create(array(
            'nombre' => 'Universidad Peruana Unión',
            'tipo_id' => 2
        ));
        Instituciones::create(array(
            'nombre' => 'Univerisad Nacional Mayor de San Marcos',
            'tipo_id' => 2
        ));
        
	}

}
