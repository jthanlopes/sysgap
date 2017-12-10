<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAvaliacoesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('avaliacoes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('empresa_avaliadora')->unsigned()->nullable();
            $table->integer('empresa_avaliada')->unsigned()->nullable();
            $table->integer('freelancer_avaliador')->unsigned()->nullable();
            $table->integer('freelancer_avaliado')->unsigned()->nullable();
            $table->integer('nota');
            $table->text('descritiva');
            $table->integer('item_id')->unsigned();
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
        Schema::dropIfExists('avaliacoes');
    }
}
