<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\CarreraInstituciones;

class CarrerasInstitucionesSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{

         CarreraInstituciones::create(array(
            'nombre' => 'Administración de Empresas',
            'institucion_id' => 1
        ));
        CarreraInstituciones::create(array(
            'nombre' => 'Contabilidad',
            'institucion_id' => 1
        )); 
        CarreraInstituciones::create(array(
            'nombre' => 'Computación e Informática',
            'institucion_id' => 1
        ));
        CarreraInstituciones::create(array(
            'nombre' => 'Administración Bancaria y Financiera',
            'institucion_id' => 1
        ));
        CarreraInstituciones::create(array(
            'nombre' => 'Marketing',
            'institucion_id' => 1
        ));
        CarreraInstituciones::create(array(
            'nombre' => 'Secretariado Ejecutivo',
            'institucion_id' => 1
        ));
        CarreraInstituciones::create(array(
            'nombre' => 'Computación e Informática',
            'institucion_id' => 2
        ));
        CarreraInstituciones::create(array(
            'nombre' => 'Administración',
            'institucion_id' => 3
        ));
        CarreraInstituciones::create(array(
            'nombre' => 'Computación e Informática',
            'institucion_id' => 3
        ));
        CarreraInstituciones::create(array(
            'nombre' => 'Construcción Civil',
            'institucion_id' => 3
        ));
        CarreraInstituciones::create(array(
            'nombre' => 'Contabilidad',
            'institucion_id' => 3
        ));
        CarreraInstituciones::create(array(
            'nombre' => 'Diseño Gráfico',
            'institucion_id' => 3
        ));
        CarreraInstituciones::create(array(
            'nombre' => 'Diseño Publicitario',
            'institucion_id' => 3
        ));
        CarreraInstituciones::create(array(
            'nombre' => 'Mecánica Automotriz',
            'institucion_id' => 3
        ));
        CarreraInstituciones::create(array(
            'nombre' => 'Mecánica de Producción',
            'institucion_id' => 3
        ));
        CarreraInstituciones::create(array(
            'nombre' => 'Secretariado Ejecutivo',
            'institucion_id' => 3
        ));
        
	}

}
