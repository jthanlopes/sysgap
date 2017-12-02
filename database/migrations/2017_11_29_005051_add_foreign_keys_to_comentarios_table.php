<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToComentariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('comentarios', function(Blueprint $table)
      {
        $table->foreign('job_id', 'fk_comen_job')->references('id')->on('jobs')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        $table->foreign('freelancer_id', 'fk_comen_freela')->references('id')->on('freelancers')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        $table->foreign('empresa_id', 'fk_comen_empre')->references('id')->on('empresas')->onUpdate('NO ACTION')->onDelete('NO ACTION');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('comentarios', function(Blueprint $table)
      {
        $table->dropForeign('fk_comen_job');
        $table->dropForeign('fk_comen_freela');
        $table->dropForeign('fk_comen_empre');
      });
    }
  }
