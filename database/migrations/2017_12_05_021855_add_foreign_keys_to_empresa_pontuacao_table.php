<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToEmpresaPontuacaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('empresa_pontuacoe', function(Blueprint $table)
        {
          $table->foreign('pontuacoe_id', 'fk_pontua_pontua')->references('id')->on('pontuacoes')->onUpdate('NO ACTION')->onDelete('NO ACTION');
          $table->foreign('empresa_id', 'fk_prod_prod_pontua')->references('id')->on('empresas')->onUpdate('NO ACTION')->onDelete('NO ACTION');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('empresa_pontuacoe', function(Blueprint $table)
        {
          $table->dropForeign('fk_pontua_pontua');
          $table->dropForeign('fk_prod_prod_pontua');
      });
    }
}
