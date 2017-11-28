<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProjectTable extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('projetos', function(Blueprint $table)
    {
      $table->increments('id');
      $table->string('titulo', 100);
      $table->text('descricao');
      $table->timestamps();
      $table->integer('empresa_id')->unsigned();
      $table->string('status', 45);
    });
  }


  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::drop('projetos');
  }

}
