<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCursoInstitucionesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('curso_instituciones', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('nombre');
			$table->integer('creditos');
			$table->integer('horas');
			$table->integer('horas_teoricas');
			$table->integer('horas_practicas');
			$table->integer('carrera_id')->unsigned()->index();
            $table->foreign('carrera_id')->references('id')->on('carrera_instituciones')->onDelete('cascade');
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
		Schema::drop('curso_instituciones');
	}

}
