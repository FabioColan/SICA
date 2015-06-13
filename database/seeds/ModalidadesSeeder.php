<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Modalidades;

class ModalidadesSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		

       
        Modalidades::create(array(
            'nombre' => 'Presencial'
           
        ));
        Modalidades::create(array(
            'nombre' => 'Espel'
           
        ));

       

	}

}
