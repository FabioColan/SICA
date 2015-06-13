<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarreraInstitucionesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('carrera_instituciones', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('nombre');
			$table->integer('institucion_id')->unsigned()->index();
            $table->foreign('institucion_id')->references('id')->on('instituciones')->onDelete('cascade');
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
		Schema::drop('carrera_instituciones');
	}

}
