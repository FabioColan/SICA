<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentacionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('documentacion', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('nombre_original');
			$table->string('nombre_actual');
			$table->string('ruta');
			$table->integer('solicitud_id')->unsigned()->index();
            $table->foreign('solicitud_id')->references('id')->on('solicitud_postulantes')->onDelete('cascade');
			$table->integer('tipo_id')->unsigned()->index();
            $table->foreign('tipo_id')->references('id')->on('tipo_documentos')->onDelete('cascade');
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
		Schema::drop('documentacion');
	}

}
