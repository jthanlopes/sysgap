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
        $table->integer('empresa_remetente')->unsigned()->nullable();
        $table->integer('freelancer_remetente')->unsigned()->nullable();
        $table->string('email_remetente', 200);
        $table->string('nome_remetente', 200);
        $table->text('mensagem');
        $table->boolean('tipo');
        $table->boolean('respondida');
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
