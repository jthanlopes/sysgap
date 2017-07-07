<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFreelancersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('freelancers', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('nome', 100);
			$table->string('email', 100)->unique();
			$table->string('password', 60);
			$table->string('foto_perfil', 100);
			$table->integer('endereco_id')->unsigned();
			$table->integer('pontuacao')->default(0);
			$table->integer('avaliacao_geral')->default(0);
			$table->timestamps();
			$table->rememberToken();
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
		Schema::drop('freelancers');
	}

}
