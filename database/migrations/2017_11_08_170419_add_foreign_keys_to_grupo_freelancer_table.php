<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToGrupoFreelancerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('grupo_freelancer', function(Blueprint $table)
        {
            $table->foreign('freelancer_id', 'fk_freela_freelancer2')->references('id')->on('freelancers')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('grupo_id', 'fk_grup_grup')->references('id')->on('grupos')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('grupo_freelancer', function(Blueprint $table)
        {
            $table->dropForeign('fk_freela_freelancer2');
            $table->dropForeign('fk_grup_grup');
        });
    }
}
