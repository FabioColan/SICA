<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpedientesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('expedientes', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('postulante_id')->unsigned()->index();
            $table->foreign('postulante_id')->references('id')->on('solicitud_postulantes')->onDelete('cascade');
            $table->integer('comision_id')->unsigned()->index();
            $table->foreign('comision_id')->references('id')->on('comision')->onDelete('cascade');
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
		Schema::drop('expedientes');
	}

}
