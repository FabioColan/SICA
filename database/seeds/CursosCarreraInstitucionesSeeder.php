<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\CursoInstituciones;

class CursosCarreraInstitucionesSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{

        CursoInstituciones::create(array(
            'nombre' => 'Matemática I',
            'creditos' => '4',
            'horas' => '2',
            'horas_teoricas' => '',
            'horas_practicas' => '',
            'carrera_id'=> 1
        ));
        CursoInstituciones::create(array(
            'nombre' => 'Matemática II',
            'creditos' => '4',
            'horas' => '3',
            'horas_teoricas' => '',
            'horas_practicas' => '',
            'carrera_id'=> 1
        ));
        CursoInstituciones::create(array(
            'nombre' => 'Lenguaje I',
            'creditos' => '2',
            'horas' => '2',
            'horas_teoricas' => '',
            'horas_practicas' => '',
            'carrera_id'=> 1
        ));
        CursoInstituciones::create(array(
            'nombre' => 'Lengua Española',
            'creditos' => '4',
            'horas' => '',
            'horas_teoricas' => '2',
            'horas_practicas' => '2',
            'carrera_id'=> 2
        ));
        CursoInstituciones::create(array(
            'nombre' => 'Calculo I',
            'creditos' => '3',
            'horas' => '2',
            'horas_teoricas' => '1',
            'horas_practicas' => '3',
            'carrera_id'=> 3
        ));
        CursoInstituciones::create(array(
            'nombre' => 'Calculo II',
            'creditos' => '3',
            'horas' => '',
            'horas_teoricas' => '2',
            'horas_practicas' => '4',
            'carrera_id'=> 3
        ));
        
	}

}
