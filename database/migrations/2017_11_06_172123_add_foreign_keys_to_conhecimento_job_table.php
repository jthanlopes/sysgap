<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToConhecimentoJobTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('conhecimento_job', function(Blueprint $table)
      {
        $table->foreign('conhecimento_id', 'fk_conheci_conheci1')->references('id')->on('conhecimentos')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        $table->foreign('job_id', 'fk_job_job1')->references('id')->on('jobs')->onUpdate('NO ACTION')->onDelete('NO ACTION');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('conhecimento_job', function(Blueprint $table)
      {
        $table->dropForeign('fk_conheci_conheci1');
        $table->dropForeign('fk_job_job1');
      });
    }
  }
