<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpresaProjetoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresa_projeto', function (Blueprint $table) {
            $table->integer('projeto_id')->unsigned();
            $table->integer('empresa_id')->unsigned();
            $table->boolean('aceito');
            $table->boolean('avaliado');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('empresa_projeto');
    }
}
