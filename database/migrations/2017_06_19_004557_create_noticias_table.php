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
			$table->increments('id');
			$table->string('titulo', 100);
			$table->text('conteudo');
			$table->string('imagem', 100);
			$table->date('data_final')->nullable();
			$table->timestamps();
			$table->boolean('ativo');
			$table->boolean('principal');
			$table->string('cidade', 45)->nullable();
			$table->string('uf', 3)->nullable();
			$table->integer('admin_id')->unsigned()->nullable();
			$table->integer('empresa_id')->unsigned()->nullable();
			$table->integer('freelancer_id')->unsigned()->nullable();
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
