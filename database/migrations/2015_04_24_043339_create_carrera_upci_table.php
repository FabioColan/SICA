<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarreraUPCITable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('carrera_upci', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('nombre')->unique();
			$table->integer('facultad_id')->unsigned()->index();
            $table->foreign('facultad_id')->references('id')->on('facultad_upci')->onDelete('cascade');
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
		Schema::drop('carrera_upci');
	}

}
