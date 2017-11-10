<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToPortifoliosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('portifolios', function(Blueprint $table)
      {
        $table->foreign('empresa_id', 'fk_porti_empresa')->references('id')->on('empresas')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        $table->foreign('freelancer_id', 'fk_porti_freela')->references('id')->on('freelancers')->onUpdate('NO ACTION')->onDelete('NO ACTION');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('portifolios', function(Blueprint $table)
      {
        $table->dropForeign('fk_porti_empresa');
        $table->dropForeign('fk_porti_freela');
      });
    }
  }
