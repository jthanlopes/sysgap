<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComentariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('comentarios', function (Blueprint $table) {
        $table->increments('id');
        $table->text('comentario');
        $table->integer('job_id')->unsigned();
        $table->integer('freelancer_id')->nullable()->unsigned();
        $table->integer('empresa_id')->nullable()->unsigned();
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
      Schema::dropIfExists('comentarios');
    }
  }
