<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEmpresasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('empresas', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('nome', 100);
			$table->string('email')->unique();
			$table->string('cnpj', 45);
			$table->string('senha', 60);
			$table->string('categoria', 45);
			$table->integer('endereco_id')->unsigned();
			$table->string('foto_perfil', 100);
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
		Schema::drop('empresas');
	}

}
