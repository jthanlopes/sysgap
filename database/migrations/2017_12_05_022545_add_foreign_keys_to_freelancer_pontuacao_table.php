<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToFreelancerPontuacaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('freelancer_pontuacao', function(Blueprint $table)
        {
          $table->foreign('pontuacao_id', 'fk_pontua_pontua_freela')->references('id')->on('pontuacoes')->onUpdate('NO ACTION')->onDelete('NO ACTION');
          $table->foreign('freelancer_id', 'fk_freela_freela_pontua')->references('id')->on('freelancers')->onUpdate('NO ACTION')->onDelete('NO ACTION');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('freelancer_pontuacao', function(Blueprint $table)
        {
          $table->dropForeign('fk_pontua_pontua_freela');
          $table->dropForeign('fk_freela_freela_pontua');
      });
    }
}
