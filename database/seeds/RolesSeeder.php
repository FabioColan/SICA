<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Roles;

class RolesSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{

        Roles::create(array(
            'name' => 'Administrador',
            'slug' => 'admin',
            'description' => 'Administra la información del sistema.',
            'level' => 1
        ));
        Roles::create(array(
            'name' => 'Alumno',
            'slug' => 'alumno',
            'description' => 'Solicita convalidación, adjunta documentación.',
            'level' => 1
        ));
        Roles::create(array(
            'name' => 'Comision',
            'slug' => 'comision',
            'description' => 'Valida documentación y convalida cursos.',
            'level' => 1
        ));
        Roles::create(array(
            'name' => 'Inactivo',
            'slug' => 'inactivo',
            'description' => 'Este estado indica que no se tiene permisos para utilizar todas las funcionalidades.',
            'level' => 1
        ));
        
	}

}
