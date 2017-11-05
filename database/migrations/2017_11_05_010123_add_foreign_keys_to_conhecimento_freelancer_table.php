<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToConhecimentoFreelancerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('conhecimento_freelancer', function(Blueprint $table)
        {
          $table->foreign('freelancer_id', 'fk_freela_freela')->references('id')->on('freelancer')->onUpdate('NO ACTION')->onDelete('NO ACTION');
          $table->foreign('conhecimento_id', 'fk_conhecim_conhecim')->references('id')->on('conhecimentos')->onUpdate('NO ACTION')->onDelete('NO ACTION');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::table('conhecimento_freelancer', function(Blueprint $table)
       {
          $table->dropForeign('fk_freela_freela');
          $table->dropForeign('fk_conhecim_conhecim');
      });
   }
    }
}


// terminar