<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToEmpresaProjetoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('empresa_projeto', function(Blueprint $table)
        {
          $table->foreign('projeto_id', 'fk_proje_proje')->references('id')->on('projetos')->onUpdate('NO ACTION')->onDelete('NO ACTION');
          $table->foreign('empresa_id', 'fk_empresa_empresa')->references('id')->on('empresas')->onUpdate('NO ACTION')->onDelete('NO ACTION');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::table('empresa_projeto', function(Blueprint $table)
       {
          $table->dropForeign('fk_proje_proje');
          $table->dropForeign('fk_empresa_empresa');
      });
    }
}
