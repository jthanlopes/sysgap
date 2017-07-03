<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToFreelancerTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('freelancer', function(Blueprint $table)
		{
			$table->foreign('endereco_id', 'fk_freela_end')->references('id')->on('endereco')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('freelancer', function(Blueprint $table)
		{
			$table->dropForeign('fk_freela_end');
		});
	}

}
