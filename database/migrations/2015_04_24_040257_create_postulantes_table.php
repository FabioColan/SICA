<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostulantesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('postulantes', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('codigo',10)->unique();
			$table->string('apellido_paterno');
			$table->string('apellido_materno');
			$table->string('nombres');
			$table->date('fecha_nacimiento');
			$table->string('lugar_nacimiento');
			$table->string('documento_identidad',8)->unique();
			$table->string('sexo', 1);
			$table->string('direccion');
			$table->string('telefono_fijo');
			$table->string('telefono_celular');
			$table->string('colegio');
			$table->string('tipo_colegio');
			$table->string('ubicacion_colegio');
			$table->string('datos_padres');
			$table->string('telefono_padres');
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
		Schema::drop('postulantes');
	}

}
