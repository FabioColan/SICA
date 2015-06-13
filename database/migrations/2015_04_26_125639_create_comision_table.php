<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComisionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('comision', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('nombres',25);
			$table->string('apellido_paterno',50);
			$table->string('apellido_materno',50);
			$table->string('dni',8);
			$table->string('telefono');
			$table->date('fecha_nacimiento'); 
			$table->string('grado_academico'); 
			$table->integer('carrera_upci_id')->unsigned()->index();
            $table->foreign('carrera_upci_id')->references('id')->on('carrera_upci')->onDelete('cascade');
			$table->integer('usuario_id')->unsigned()->index();
            $table->foreign('usuario_id')->references('id')->on('users')->onDelete('cascade');
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
		Schema::drop('comision');
	}

}
