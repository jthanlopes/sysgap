<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEnderecoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('endereco', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('cep', 10);
			$table->string('logradouro', 100);
			$table->integer('numero');
			$table->string('complemento', 45)->nullable();
			$table->string('bairro', 45);
			$table->string('cidade', 45);
			$table->string('uf', 3);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('endereco');
	}

}
