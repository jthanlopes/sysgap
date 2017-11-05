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
        $table->foreign('freelancer_id', 'fk_freela_freela2')->references('id')->on('freelancers')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        $table->foreign('conhecimento_id', 'fk_conhecimento_conhecimento')->references('id')->on('conhecimentos')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        $table->string('tempo_experiencia', 45);
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
      $table->dropForeign('fk_freela_freela2');
      $table->dropForeign('fk_conhecimento_conhecimento');
    });
   }
 }


// terminar