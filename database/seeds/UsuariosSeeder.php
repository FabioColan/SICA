<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\User;

class UsuariosSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
        User::create(array(
            'name' => 'Rubén Bustillos',
            'email' => 'ruben@gmail.com',
            'password' => bcrypt('123456'),
            'foto' => ''
        ));
        User::create(array(
            'name' => 'Administrador',
            'email' => 'administrador@gmail.com',
            'password' => bcrypt('123456'),
            'foto' => ''
        ));
	}
}
