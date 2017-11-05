<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToAvaliacoesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('avaliacoes', function(Blueprint $table)
        {
            $table->foreign('empresa_avaliadora', 'fk_avalia_empresa1')->references('id')->on('empresas')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('empresa_avaliada', 'fk_avalia_empresa2')->references('id')->on('empresas')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('freelancer_avaliador', 'fk_avalia_freela1')->references('id')->on('freelancers')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('freelancer_avaliado', 'fk_avalia_freela2')->references('id')->on('freelancers')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('item_id', 'fk_avalia_item')->references('id')->on('items')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('avaliacoes', function(Blueprint $table)
        {
            $table->dropForeign('fk_avalia_empresa1');
            $table->dropForeign('fk_avalia_empresa2');
            $table->dropForeign('fk_avalia_freela1');
            $table->dropForeign('fk_avalia_freela2');
            $table->dropForeign('fk_avalia_item');
        });
    }
}
