<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToGrupoJobTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('grupo_job', function(Blueprint $table)
      {
        $table->foreign('job_id', 'fk_job_job2')->references('id')->on('jobs')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        $table->foreign('grupo_id', 'fk_grup_grup3')->references('id')->on('grupos')->onUpdate('NO ACTION')->onDelete('NO ACTION');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('grupo_job', function(Blueprint $table)
      {
        $table->dropForeign('fk_job_job2');
        $table->dropForeign('fk_grup_grup3');
      });
    }
  }
