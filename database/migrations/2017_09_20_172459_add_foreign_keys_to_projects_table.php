<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToProjectsTable extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table('projetos', function(Blueprint $table)
    {
      $table->foreign('empresa_id', 'fk_projet_empres')->references('id')->on('empresas')->onUpdate('NO ACTION')->onDelete('NO ACTION');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table('projetos', function(Blueprint $table)
    {
      $table->dropForeign('fk_projet_empres');
    });
  }

}
