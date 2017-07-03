<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToFreelancersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('freelancers', function(Blueprint $table)
		{
			$table->foreign('endereco_id', 'fk_freela_end')->references('id')->on('enderecos')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('freelancers', function(Blueprint $table)
		{
			$table->dropForeign('fk_freela_end');
		});
	}

}
