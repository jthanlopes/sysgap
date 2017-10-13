<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToConhecimentoEmpresaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('conhecimento_empresa', function(Blueprint $table)
        {
          $table->foreign('empresa_id', 'fk_empres_empres')->references('id')->on('empresas')->onUpdate('NO ACTION')->onDelete('NO ACTION');
          $table->foreign('conhecimento_id', 'fk_conheci_conheci')->references('id')->on('conhecimentos')->onUpdate('NO ACTION')->onDelete('NO ACTION');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('conhecimento_empresa', function(Blueprint $table)
       {
          $table->dropForeign('fk_empres_empres');
          $table->dropForeign('fk_conheci_conheci');
      });
   }
}
