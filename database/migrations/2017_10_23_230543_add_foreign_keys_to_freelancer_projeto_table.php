<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToFreelancerProjetoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('freelancer_projeto', function(Blueprint $table)
        {
          $table->foreign('projeto_id', 'fk_proj_proj')->references('id')->on('projetos')->onUpdate('NO ACTION')->onDelete('NO ACTION');
          $table->foreign('freelancer_id', 'fk_freela_freela')->references('id')->on('freelancers')->onUpdate('NO ACTION')->onDelete('NO ACTION');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('freelancer_projeto', function(Blueprint $table)
       {
          $table->dropForeign('fk_proj_proj');
          $table->dropForeign('fk_freela_freela');
      });
   }
}
