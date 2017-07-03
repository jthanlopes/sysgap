<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFreelancerTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('freelancer', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('nome', 100);
			$table->string('email', 100);
			$table->string('senha', 60);
			$table->string('foto_perfil', 100);
			$table->integer('endereco_id')->unsigned();
			$table->integer('pontuacao')->default(0);
			$table->integer('avaliacao_geral')->default(0);
			$table->timestamps();
			$table->boolean('ativo');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('freelancer');
	}

}
