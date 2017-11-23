<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToEmpresaJobTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('empresa_job', function(Blueprint $table)
        {
          $table->foreign('job_id', 'fk_job_job_prod')->references('id')->on('jobs')->onUpdate('NO ACTION')->onDelete('NO ACTION');
          $table->foreign('empresa_id', 'fk_prod_prod')->references('id')->on('empresas')->onUpdate('NO ACTION')->onDelete('NO ACTION');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::table('empresa_job', function(Blueprint $table)
       {
          $table->dropForeign('fk_job_job_prod');
          $table->dropForeign('fk_prod_prod');
      });
    }
}
