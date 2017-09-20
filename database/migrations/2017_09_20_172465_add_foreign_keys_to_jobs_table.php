<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToJobsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('jobs', function(Blueprint $table)
		{
			$table->foreign('empresa_id', 'fk_job_empres')->references('id')->on('empresas')->onUpdate('NO ACTION')->onDelete('NO ACTION');

			$table->foreign('projeto_id', 'fk_job_projet')->references('id')->on('projetos')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('jobs', function(Blueprint $table)
		{
			$table->dropForeign('fk_job_empres');
			$table->dropForeign('fk_job_projet');
		});
	}

}
