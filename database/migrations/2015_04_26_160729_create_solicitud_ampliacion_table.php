<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSolicitudAmpliacionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('solicitud_ampliacion', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('solicitud_postulante_id')->unsigned()->index();
            $table->foreign('solicitud_postulante_id')->references('id')->on('solicitud_postulantes')->onDelete('cascade');
            $table->integer('estado_id')->unsigned()->index();
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
		Schema::drop('solicitud_ampliacion');
	}

}
