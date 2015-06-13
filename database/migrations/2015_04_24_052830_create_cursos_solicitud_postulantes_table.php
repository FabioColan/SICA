<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCursosSolicitudPostulantesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cursos_solicitud_postulantes', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('nombre');
			$table->integer('creditos');
			$table->integer('horas');
			$table->integer('horas_teoricas');
			$table->integer('horas_practicas');
			$table->integer('nota');
			$table->integer('solicitud_id')->unsigned()->index();
            $table->foreign('solicitud_id')->references('id')->on('solicitud_postulantes')->onDelete('cascade');
            $table->integer('curso_institucion_id')->unsigned()->index();
            $table->foreign('curso_institucion_id')->references('id')->on('curso_instituciones')->onDelete('cascade');
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
		Schema::drop('cursos_solicitud_postulantes');
	}

}
