<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePortifoliosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('portifolios', function (Blueprint $table) {
            $table->increments('id');
            $table->string('titulo', 50);
            $table->string('imagem', 100);
            $table->string('link', 100);
            $table->integer('empresa_id')->unsigned()->nullable();
            $table->integer('freelancer_id')->unsigned()->nullable();
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
        Schema::dropIfExists('portifolios');
    }
}
