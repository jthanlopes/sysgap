<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToFreelancerJobTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('freelancer_job', function(Blueprint $table)
        {
          $table->foreign('job_id', 'fk_job_job')->references('id')->on('jobs')->onUpdate('NO ACTION')->onDelete('NO ACTION');
          $table->foreign('freelancer_id', 'fk_freelan_freelan')->references('id')->on('freelancers')->onUpdate('NO ACTION')->onDelete('NO ACTION');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::table('freelancer_job', function(Blueprint $table)
       {
          $table->dropForeign('fk_job_job');
          $table->dropForeign('fk_freelan_freelan');
      });
    }
}
