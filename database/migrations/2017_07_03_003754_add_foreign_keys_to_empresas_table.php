<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToEmpresasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('empresas', function(Blueprint $table)
		{
			$table->foreign('endereco_id', 'fk_empresa_end')->references('id')->on('enderecos')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('empresas', function(Blueprint $table)
		{
			$table->dropForeign('fk_empresa_end');
		});
	}

}
