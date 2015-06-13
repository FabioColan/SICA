<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarreraInstitucionCarreraUpciTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('carrera_institucion_carrera_upci', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('carrera_institucion_id')->unsigned()->index();
            $table->foreign('carrera_institucion_id')->references('id')->on('carrera_instituciones')->onDelete('cascade');
            $table->integer('carrera_upci_id')->unsigned()->index();
            $table->foreign('carrera_upci_id')->references('id')->on('carrera_upci')->onDelete('cascade');
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
		Schema::drop('carrera_institucion_carrera_upci');
	}

}
