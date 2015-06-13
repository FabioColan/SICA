<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMemorandosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('memorandos', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('codigo');
			$table->string('para');
			$table->string('de');
			$table->string('asunto');
			$table->date('fecha');
			$table->string('descripcion');
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
		Schema::drop('memorandos');
	}

}
