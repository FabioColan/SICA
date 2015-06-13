<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\CursosInstitucionTipo;

use App\TipoDocumento;

class TipoDocumentosSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{

        TipoDocumento::create(array(
            'nombre' => 'Silabos de Estudios'
        ));
        TipoDocumento::create(array(
            'nombre' => 'Certificado de Estudios'
        ));
       TipoDocumento::create(array(
            'nombre' => 'Título Profesional'
        ));
        TipoDocumento::create(array(
            'nombre' => 'Otro Documento'
        ));
	}

}
