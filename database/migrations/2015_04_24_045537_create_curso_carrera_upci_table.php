<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCursoCarreraUPCITable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('curso_carrera_upci', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('nombre');
			$table->string('codigo');
			$table->string('creditos');
			$table->string('hora_teorica');
			$table->string('hora_practica');
			$table->string('th');
			$table->integer('ciclo_upci_id')->unsigned()->index();
            $table->foreign('ciclo_upci_id')->references('id')->on('ciclo_upci')->onDelete('cascade');
			$table->integer('carrera_upci_id')->unsigned()->index();
            $table->foreign('carrera_upci_id')->references('id')->on('carrera_upci')->onDelete('cascade');
            $table->integer('plan_upci_id')->unsigned()->index();
            $table->foreign('plan_upci_id')->references('id')->on('plan_estudios_upci')->onDelete('cascade');
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
		Schema::drop('curso_carrera_upci');
	}

}
