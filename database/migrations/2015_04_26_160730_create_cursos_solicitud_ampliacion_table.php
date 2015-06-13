<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCursosSolicitudAmpliacionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cursos_solicitud_ampliacion', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('nombre');
			$table->integer('creditos');
			$table->integer('horas');
			$table->integer('horas_teoricas');
			$table->integer('horas_practicas');
			$table->integer('solicitud_ampliacion_id')->unsigned()->index();
            $table->foreign('solicitud_ampliacion_id')->references('id')->on('solicitud_ampliacion')->onDelete('cascade');
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
		Schema::drop('cursos_solicitud_ampliacion');
	}

}
