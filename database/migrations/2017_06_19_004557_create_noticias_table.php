<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNoticiasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('noticias', function(Blueprint $table)
		{
			$table->increments('id')->primary();
			$table->string('titulo', 45);
			$table->string('conteudo', 200);
			$table->string('imagem', 100);
			$table->timestamps('data_cadastro');
			$table->date('data_final')->nullable();
			$table->boolean('ativo');
			$table->integer('administrador_id')->unsigned();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('noticias');
	}

}
