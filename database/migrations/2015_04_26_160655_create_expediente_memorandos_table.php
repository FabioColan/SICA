<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpedienteMemorandosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('expediente_memorandos', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('expediente_id')->unsigned()->index();
            $table->foreign('expediente_id')->references('id')->on('expedientes')->onDelete('cascade');
			$table->integer('memorando_id')->unsigned()->index();
            $table->foreign('memorando_id')->references('id')->on('memorandos')->onDelete('cascade');
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
		Schema::drop('expediente_memorandos');
	}

}
