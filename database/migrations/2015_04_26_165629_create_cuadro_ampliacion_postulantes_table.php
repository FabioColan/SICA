<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCuadroAmpliacionPostulantesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cuadro_ampliacion_postulantes', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('solicitud_ampliacion_id')->unsigned()->index();
            $table->foreign('solicitud_ampliacion_id')->references('id')->on('solicitud_ampliacion')->onDelete('cascade');
			$table->integer('expediente_id')->unsigned()->index();
            $table->foreign('expediente_id')->references('id')->on('expedientes')->onDelete('cascade');
            $table->integer('curso_carrera_upci_id')->unsigned()->index();
            $table->foreign('curso_carrera_upci_id')->references('id')->on('curso_carrera_upci')->onDelete('cascade');
            $table->integer('curso_soli_amp_id')->unsigned()->index();
            $table->foreign('curso_soli_amp_id')->references('id')->on('cursos_solicitud_ampliacion')->onDelete('cascade');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('cuadro_ampliacion_postulantes');
	}

}
