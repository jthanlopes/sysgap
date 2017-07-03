<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToEmpresaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('empresa', function(Blueprint $table)
		{
			$table->foreign('endereco_id', 'fk_prod_end')->references('id')->on('endereco')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('empresa', function(Blueprint $table)
		{
			$table->dropForeign('fk_prod_end');
		});
	}

}
