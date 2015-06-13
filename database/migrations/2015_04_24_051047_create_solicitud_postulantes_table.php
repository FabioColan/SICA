<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSolicitudPostulantesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('solicitud_postulantes', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('postulante_id',10);
			//$table->integer('postulante_id')->unsigned()->index();
            //$table->foreign('postulante_id')->references('id')->on('postulantes')->onDelete('cascade');
			$table->integer('instituciones_id')->unsigned()->index(); //institucion de procedencia (Universidad o Instituto Superior)
            $table->foreign('instituciones_id')->references('id')->on('instituciones')->onDelete('cascade');
			$table->integer('carrera_instit_id')->unsigned()->index(); //carrera de procedencia
			$table->foreign('carrera_instit_id')->references('id')->on('carrera_instituciones')->onDelete('cascade');
			$table->string('ciclo_estudio');
			$table->integer('carrera_upci_id')->unsigned()->index(); //carrera que estudiará en la UPCI
			$table->foreign('carrera_upci_id')->references('id')->on('carrera_upci')->onDelete('cascade');
			$table->integer('modalidad_id')->unsigned()->index(); //modalidad de ingreso a la UPCI
			$table->foreign('modalidad_id')->references('id')->on('modalidades')->onDelete('cascade');
			$table->integer('estado_id')->unsigned()->index(); //identificador para controlar el acceso a las vistas
			$table->foreign('estado_id')->references('id')->on('estados')->onDelete('cascade');
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
		Schema::drop('solicitud_postulantes');
	}

}
