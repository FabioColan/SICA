<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Postulante;

class PostulanteSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		

        Postulante::create(array(
            'nombre' => 'Ing. de Sistemas e Informática'

        ));

       

	}

}
