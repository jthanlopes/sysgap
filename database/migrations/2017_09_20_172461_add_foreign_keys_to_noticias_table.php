<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToNoticiasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('noticias', function(Blueprint $table)
		{
			$table->foreign('admin_id', 'fk_noticia_admin')->references('id')->on('admins')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('empresa_id', 'fk_noticia_empresa')->references('id')->on('empresas')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('freelancer_id', 'fk_noticia_freela')->references('id')->on('freelancers')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('noticias', function(Blueprint $table)
		{
			$table->dropForeign('fk_noticia_admin');
			$table->dropForeign('fk_noticia_empresa');
			$table->dropForeign('fk_noticia_freela');
		});
	}

}
