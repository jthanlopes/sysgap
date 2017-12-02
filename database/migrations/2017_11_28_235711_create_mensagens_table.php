<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMensagensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mensagens', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('empresa_destinataria')->unsigned();
            $table->integer('empresa_remetente')->unsigned();
            $table->integer('freelancer_remetente')->unsigned();
            $table->integer('freelancer_destinatario')->unsigned();
            $table->integer('admin_destinatario')->unsigned();
            $table->text('mensagem');
            $table->boolean('tipo');
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
        Schema::dropIfExists('mensagens');
    }
}
