<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateConhecimentosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('conhecimentos', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('titulo', 50);
			$table->string('descricao', 100)->nullable();
			$table->boolean('padrao');
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
		Schema::drop('conhecimentos');
	}

}
