<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\CicloUPCI;

class CicloUPCISeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{

        CicloUPCI::create(array(
            'nombre' => 'Primer Ciclo',
            'abreviatura' => 'I'
        ));
        CicloUPCI::create(array(
            'nombre' => 'Segundo Ciclo',
            'abreviatura' => 'II'
        ));
        CicloUPCI::create(array(
            'nombre' => 'Tercer Ciclo',
            'abreviatura' => 'III'
        ));
        CicloUPCI::create(array(
            'nombre' => 'Cuarto Ciclo',
            'abreviatura' => 'IV'
        ));
        CicloUPCI::create(array(
            'nombre' => 'Quinto Ciclo',
            'abreviatura' => 'V'
        ));
        CicloUPCI::create(array(
            'nombre' => 'Sexto Ciclo',
            'abreviatura' => 'VI'
        ));
        CicloUPCI::create(array(
            'nombre' => 'Septimo Ciclo',
            'abreviatura' => 'VII'
        ));
        CicloUPCI::create(array(
            'nombre' => 'Octavo Ciclo',
            'abreviatura' => 'VIII'
        ));
        CicloUPCI::create(array(
            'nombre' => 'Noveno Ciclo',
            'abreviatura' => 'XI'
        ));
        CicloUPCI::create(array(
            'nombre' => 'Decimo Ciclo',
            'abreviatura' => 'X'
        ));

	}

}
